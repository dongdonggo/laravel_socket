<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Model\AdminRole;
use App\Model\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminroleController extends Controller
{
    /**
     * 搜素查询上
     */
    public function show (Request $request)
    {
        $data = AdminRole::where('name', 'like', '%'.$request->get('name').'%')
                    ->where('description', 'like', '%'.$request->get('description').'%')
                    ->paginate(15);
        return view('admin.dev.adminrole.show',compact('data'));
    }
    /**
     * 创建
     */
    public function create (Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.dev.adminrole.add');
        }
         AdminRole::create($request->all());
        return redirect('/admin/dev/roles/show');
    }

    /**
     * 修改
     */
    public function update (Update $request)
    {
        $res = Role::where('id', $request->get('id'))->update($request->all());
        if ($res) {
            return returnSuccess($res, '修改成功');
        }
        return returnFail('', '修改失败');
    }

    /**
     * 删除
     */
    public function delete(Delete $request)
    {
        try {
            $res = Role::where('id', $request->get('id'))->delete();
        } catch (\Exception $exception) {
            return returnFail('', '有其他数据进行了关联，请先清理其他关联数据再执行此操作');
        }
        if ($res) {
            return returnSuccess($res, '删除成功');
        }
        return returnFail('', '删除失败');
    }

    /**
     * 用户角色查询 users_id
     */
    public function userRoleQuery(Request $request)
    {
        $data  = User::with('roles')->get()->toArray();
        return returnSuccess($data, 'success');
    }
}
