<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19 0019
 * Time: 下午 4:08
 */

namespace App\Services;


use App\Model\AdminRole;
use App\Model\AdminUser;
use App\Model\AdminUserRole;
use App\Model\CustomMessage;
use App\Model\CustomServe;
use App\Model\Wait;
use GatewayClient\Gateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    protected $adminid;
    protected $uid;
    protected $client_id;
//    public function __construct($adminid, $uid, $client_id)
//    {
//        $this->adminid = $adminid;
//        $this->uid = $uid;
//        $this->client_id = $client_id;
//    }

    # 会话开始
    public function chatInit($adminid, $uid)
    {
        # 添加正在会话记录
        app(CustomServe::class)->add($adminid, $uid);
        # 广播等待人数
        $this->sendWaitNum();
        # 向客服发送
        $this->sendCustomerInit($uid, $adminid);
        # 向客户发送
        $this->sendUserInit($uid ,$adminid);
    }
    /**
     *判断客服是否有空闲 获取空闲客服ID
     * @return bool|integer 客服id
     */
    public function  isFreeCustomer()
    {
        #客服角色id
        $customerRoleId= app(AdminRole::class)->getCustomId();
        $Customers = AdminUserRole::query()
            ->where('aroles_id', $customerRoleId)
            ->pluck('ausers_id');
        $onlineUids = [];
        foreach ( $Customers as $adminid) {
            if (Gateway::isUidOnline($adminid)) {
                array_push($onlineUids,$adminid);
            }
        }
        if(empty($onlineUids)) {
            Log::stack(['socket'])->info('isFreeCustomer   onlineUids is empty');
            return false;
        }
        $sort = [];
        $customserve = CustomServe::query()
            ->select(DB::raw('count(*) as serve_count, ausers_id'))
            ->whereIn('ausers_id', $onlineUids)
            ->groupBy('ausers_id')
            ->get()->map(function ($item) use(&$sort){
                $sort[$item['ausers_id']] = $item['serve_count'];
            });
            if (empty($sort)) {
                Log::stack(['socket'])->info('isFreeCustomer  CustomServe query is empty');
//                return false;
            }
         foreach ($onlineUids as $vaid) {
             $sort[$vaid] = isset($sort[$vaid]) ? $sort[$vaid] : 0;
         }
         asort($sort);
        if (reset($sort) >= 3) {
            Log::stack(['socket'])->info('isFreeCustomer  sort data full'.json_encode($sort));
            return false;
        }
        return key($sort);

    }

    /**
     * 向 客户广播等待人数
     */
    public function sendWaitNum()
    {
        #向每个人进行广播
        #获取顺序
        $sort = Wait::query()->orderBy('id', 'asc')->get();
        foreach ($sort as $key=>$value) {
            $value['sort'] = $key;
            msgByUid($value, $value['tempuser_id']);
        }
    }

    #向客服 发送 客户的uid 初始会话连接
    public function sendCustomerInit($uid, $adminid)
    {
        return msgByUid(['uid' => $uid], $adminid, 'sys', 'msginit', '开始会话');
    }

    #向 客户发送 客户id
    public function sendUserInit($uid, $adminid)
    {
        return msgByUid(['adminid' => $adminid], $uid, 'sys', 'msginit', '开始会话');
    }


    /**
     * 过滤已经联系过的用户
     */
    public function alreadyUseFillter($uid, $client_id)
    {
        $ask = $this->alreadyAskUser($uid, $client_id);
        $wait = $this->alreadyWait($uid, $client_id);
        if (!$ask && !$wait) {
            #客服已满
            if (!$adminid = $this->isFreeCustomer()) {
                # 插入等待表，
                $wait = app(Wait::class)->add($uid);
                return returnSuccess($wait,'alreadyUseFillter new wait success');
            } else {
                $this->chatInit($adminid, $uid);
                return returnSuccess('','chat success');
            }
        }
        return $ask?$ask:$wait;
    }
    /**
     * 之前咨询过的用户，连接已关闭了，直接，排队给相关工作人员。
     */
    public function alreadyAskUser($uid,$client_id)
    {

        $msg = CustomMessage::query()
            ->where('person_id',$uid)
            ->orderBy('created_at','desc')
            ->first();
        if ($msg) {  #，之前咨询过的用户，连接已关闭了，直接，排队给相关工作人员。
            $wait = app(Wait::class)->add($uid,$msg->ausers_id);
            Gateway::bindUid($client_id, $uid);
            return returnSuccess( $wait,'wait success');
        }

    }

    # 已经在等待的用户
    public function alreadyWait($uid,$client_id)
    {
        $hwait = Wait::query()
            ->where('tempuser_id', $uid )
            ->first();

        if ($hwait) { # 之前已经排队， 重新绑定
            Gateway::bindUid($client_id, $uid);
            return returnSuccess($hwait,'old wait success');
        }
    }
    # 新客户 绑定并 进行等待
    public function newBindWait($client_id)
    {
        # 进行绑定
        #临时uid。
        $ordernum = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        #绑定订单号
        Gateway::bindUid($client_id,$ordernum);
        session([ 'uid' => $ordernum ]);
        #客服已满
        if (!$adminid = $this->isFreeCustomer()) {
            # 插入等待表，
            $wait = app(Wait::class)->add($ordernum);
            return returnSuccess($wait,'newBindWait new wait success');
        } else {
            $this->chatInit($adminid, $ordernum);
            return returnSuccess('','newBindWait chatInit  success');
        }


    }
}