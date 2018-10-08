<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Model\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{

    /**
     * 創建or修改 修改用戶角色 绑定用户角色
     */
    public function create (Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'roles_id' => 'required|exists:roles,id',
        ],[
            'required' => '参数不完整'
        ]);

        $res  = UserRole::updateOrCreate(
            ['users_id' => $request->get('users_id')],
            $request->all());
        if ($res) {
            return returnSuccess($res,'操作成功');
        }
        return returnFail('','操作失败');
    }

}
