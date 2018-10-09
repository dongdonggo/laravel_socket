<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Model\AdminRole;
use App\Model\AdminUser;
use App\Model\AdminUserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    // 后台用户管理
    public function showAdminUser()
    {
        $users = AdminUser::with('roles')->paginate(15);
        return view('admin.dev.adminusers',compact('users'));
    }

    # 添加后台用户
    public function addAdminUser(Request $request)
    {
        if ($request->getMethod() == "GET") {
             $roles = app(AdminRole::class)->getall();
            return view('admin.dev.addusers', compact('roles'));
        }

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
                'role' => 'required'
            ], [
                'required' => '参数未填完整',
                'exists' => '数据错误'
            ]
        );
        $roleid = $request->get('role');
        $data = $request->all();
        unset($data['role']);
        $res = AdminUser::create($data);
        if ($res) {
            app(AdminUserRole::class)->add([
                'ausers_id' => $res->id,
                'aroles_id' => $roleid
            ]);
//            abort(200,'成功');
        }
        return redirect('/admin/dev/users/show');

    }

    # 修改后台用户
    public function updateAdminUser()
    {

    }
}
