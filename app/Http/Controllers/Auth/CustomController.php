<?php

namespace App\Http\Controllers\Auth;

use App\Model\AdminUser;
use App\Model\CustomMessage;
use App\Model\Wait;
use App\Services\CustomerService;
use GatewayClient\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    protected  $custom;
    public function __construct(CustomerService $customerService)
    {
        $this->custom = $customerService;
    }
    // # 获取消息记录
    // 目前等待人数
    //  目前服务人数
    // 开始工作， 暂停工作
    # 进入等待时，开启一个job 为每5分钟 进行提醒
    #一个客服最多服务2个人，结束后，关闭会话 触发排号系统

     #客服会话列表
    public function show(Request $request)
    {
//        $this->middleware(['adminouth']);
        $admin = $request->admin;
//        dump($admin);
        # 关联查询  直接查询  group by 之后 反向关联查询
        $data = CustomMessage::query()
            ->where('ausers_id',$admin->id)
            ->groupBy('person_id')
            ->get()->toArray();
        return view('admin.dev.custom.show', compact('data'));
    }



    /**
     *  客服绑定
     */
    public function socketBindPerson(Request $request)
    {
        # 登录用户验证
     $request->validate([
            'client_id' => 'required',
        ],[
            'request data is error'
        ]);
        $client_id = $request->get('client_id');
        $uid = session('uid');

        #已经咨询过的用户进行过滤处理



        $this->custom->alreadyAskUser($uid);
        $hwait = Wait::query()
             ->where('tempuser_id',$uid )
             ->first();



        if ($hwait) { # 之前已经排队， 重新绑定
            Gateway::bindUid($client_id,$hwait->tempuser_id);
            return returnSuccess($hwait,'old wait success');
        }
            # 进行绑定
            #临时uid。
            $ordernum = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            #绑定订单号
            Gateway::bindUid($client_id,$ordernum);
            session([ 'uid' => $ordernum ]);
            #
            # 插入等待表，
            $wait = app(Wait::class)->add($ordernum);

            return returnSuccess($wait,'new wait success');

    }


    
    /**
     * 验证 客服认证 绑定Uid
     */
    public function socketBindAdmin(Request $request)
    {
        $admin = $request->admin;
        # 登录用户验证
        $request->validate([
            'client_id' => 'required',
        ],[
            'request data is error'
        ]);
             # 检测 此 client_id 已被绑定
            $uid = Gateway::getUidByClientId($request->get('client_id'));
        if ($uid) {
            # 为恶意 进行绑定  封号
            #.....
            # 清除session
            $request->session()->flush();
            return returnFail('','bind fail');
        }
            #   检测uid 是否已经绑定
            $bindids = Gateway::getClientIdByUid($admin->id);
            if (!empty($bindids)) {  # 客服在其他地方登录，进行解绑 重新绑定
                foreach ($bindids as $val) {
                    Gateway::closeClient($val); # 关闭其他的地方的链接
                }
            }
        Gateway::bindUid($request->get('client_id'), $admin->id);
        $adminuser = AdminUser::find($admin->id);
        $adminuser -> online = 1; # 上线
        $adminuser->save();
        return returnSuccess('','bind success');
    }

    /**
     * 绑定 无账号 用户client
     */

}

