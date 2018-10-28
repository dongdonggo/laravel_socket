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
    protected $maxServe = 300; #单个客服 最大接待人数
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
        $this->sendUserInit($uid, $adminid);
    }

    /**
     *判断客服是否有空闲 获取空闲客服ID
     * $uid 定向查询 某个用户是否空闲
     * @return bool|integer 客服id
     */
    public function isFreeCustomer($uid=null)
    {
        #客服角色id
        $customerRoleId = app(AdminRole::class)->getCustomId();
        $Customers = AdminUserRole::query()
            ->where('aroles_id', $customerRoleId)
            ->pluck('ausers_id');
        $onlineUids = [];
        foreach ($Customers as $adminid) {
            if (Gateway::isUidOnline($adminid)) {
                array_push($onlineUids, $adminid);
            }
        }
        if (empty($onlineUids)) {
            Log::stack(['socket'])->info('isFreeCustomer   onlineUids is empty');
            return false;
        }
        $sort = [];
        $customserve = CustomServe::query()
            ->select(DB::raw('count(*) as serve_count, ausers_id'))
            ->whereIn('ausers_id', $onlineUids)
            ->groupBy('ausers_id')
            ->get()->map(function ($item) use (&$sort) {
                $sort[$item['ausers_id']] = $item['serve_count'];
            });

        # 定向查询
        if ($uid) {
            return isset($sort[$uid])&&($sort[$uid]<$this->maxServe)?$uid:false;
        }

        if (empty($sort)) {
            Log::stack(['socket'])->info('isFreeCustomer  CustomServe query is empty');
//                return false;
        }
        foreach ($onlineUids as $vaid) {
            $sort[$vaid] = isset($sort[$vaid]) ? $sort[$vaid] : 0;
        }


        asort($sort);
        if (reset($sort) >= $this->maxServe) {
            Log::stack(['socket'])->info('isFreeCustomer  sort data full' . json_encode($sort));
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
        foreach ($sort as $key => $value) {
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
        # 绑定
        $this->uidClientBind($uid, $client_id);
        # 查询wait 是否在等待
        if (!$this->isWait($uid)) {
            # 查询message 是否有消息记录
            if ($premsg = $this->isMessage($uid)) {
                Log::stack(['socket'])->info('查询message 是否有消息记录 yes ');
                # 有消息记录  # pre 客服有空闲 进行会话 否则进入等待
                return $this->acceptMiddle($uid, $premsg->ausers_id);
            } else {
                # 无消息记录，特殊情况，发生在调试时 手动删除了记录 情况
                return ($adminid = $this->isFreeCustomer()) && $this->chatInit($adminid, $uid)?# pre 客服有空闲 进行会话
                 returnSuccess('', 'alreadyUseFillter chatinit  success'):
                returnFail('', 'alreadyUseFillter isFreeCustomer  fail');
            }
        }
        return returnSuccess('', 'alreadyUseFillter  old  wait');
    }

    # 新客户 绑定并 进行等待
    public function newBindWait($client_id)
    {
        #临时uid。
        $uid = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

        #绑定订单号
        $this->uidClientBind($uid, $client_id);
        session(['uid' => $uid]);
        return $this->acceptMiddle($uid);
    }

    /**
     * 接受客户，进行处理
     * @param $uid
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function acceptMiddle($uid, $customid=null)
    {
        #客服已满
        if (!$adminid = $this->isFreeCustomer($customid)) {
            # 插入等待表，
            $this->newWaiting($uid);
            return returnSuccess('', 'acceptMiddle wait  success');
        } else {
            $this->chatInit($adminid, $uid);
            return returnSuccess('', 'acceptMiddle chatInit  success');
        }
    }

    # 查询wait 是否在等待
    public function isWait($uid)
    {
        $hwait = Wait::query()
            ->where('tempuser_id', $uid)
            ->first();
        if ($hwait) {
            return $hwait;
        }
            return false;
    }

    #查询 message 是否已存在
    public function isMessage($uid)
    {
        $msg = CustomMessage::query()
            ->where('person_id', $uid)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($msg) {
            return $msg;
        }
        return false;
    }

    # 绑定uid client_id
    public function uidClientBind($uid,$client)
    {
        Gateway::bindUid($client, $uid);
    }

    /**
     *    # 进行等待
     * @param $uid  用户id
     * @param null $customid  定向咨询时 客服id
     * @return mixed
     */
    public function newWaiting($uid, $customid=null)
    {
       return  $wait = app(Wait::class)->add($uid, $customid);
    }
}