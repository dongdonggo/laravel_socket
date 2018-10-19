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
use App\Model\CustomServe;
use App\Model\Wait;
use GatewayClient\Gateway;

class CustomerService
{


    /**
     * 接待客服
     * @return array
     */
    public function  isFreeCustomer()
    {
        #客服角色id
        $customerRoleId= app(AdminRole::class)->getCustomId();
        $Customers = AdminUserRole::query()
            ->select('ausers_id')
            ->where('aroles_id', $customerRoleId)
            ->get()
            ->toArray();
        $onlineUids = [];
        foreach ( $Customers as $uid) {
            if (Gateway::isUidOnline($uid)) {
                array_push($onlineUids,$uid);
            }
        }
        return $onlineUids;

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

    /**
     * 过滤已经联系过的用户
     */
    public function alreadyUseFillter($uid)
    {
        $this->alreadyAskUser($uid);
        $this->alreadyWait($uid);
    }
    /**
     * 之前咨询过的用户，连接已关闭了，直接，排队给相关工作人员。
     */
    public function alreadyAskUser($uid)
    {
        $msg = CustomMessage::query()
            ->where('person_id',$uid)
            ->orderBy('created_at','desc')
            ->first();
        if ($msg) {  #，之前咨询过的用户，连接已关闭了，直接，排队给相关工作人员。
            $wait = app(Wait::class)->add($uid,$msg->ausers_id);
            return returnSuccess( $wait,'wait success');
        }
    }

    # 已经在等待的用户
    public function alreadyWait($uid)
    {
        $msg = CustomMessage::query()
            ->where('person_id',$uid)
            ->orderBy('created_at','desc') 
            ->first();
        if ($msg) {  #，之前咨询过的用户，连接已关闭了，直接，排队给相关工作人员。
            $wait = app(Wait::class)->add($uid,$msg->ausers_id);
            return returnSuccess('','wait success');
        }
    }
}