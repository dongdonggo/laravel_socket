<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Model\AdminUser;
use App\Model\CustomMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    // # 获取消息记录
    // 目前等待人数
    //  目前服务人数
    // 开始工作， 暂停工作
    # 进入等待时，开启一个job 为每5分钟 进行提醒
    #一个客服最多服务2个人，结束后，关闭会话 触发排号系统

     #客服会话列表
    public function show(Request $request)
    {
        $admin = $request->admin;
        # 关联查询  直接查询  group by 之后 反向关联查询
        $data = CustomMessage::with('user')
            ->where('ausers_id',$admin->id)
            ->groupBy('users_id')
            ->get()->toArray();
        return view('admin.dev.custom.show', compact('data'));
    }

    /*
     * socket 认证
     */
    public function getToken()
    {

    }

}
