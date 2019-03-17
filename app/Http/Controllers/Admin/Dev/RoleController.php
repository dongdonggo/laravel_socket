<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Http\Requests\Admin\Dev\Role\Create;
use App\Http\Requests\Admin\Dev\Role\Delete;
use App\Http\Requests\Admin\Dev\Role\Update;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * 搜素查询上
     */
    public function show (Request $request)
    {
        $data = Role::where('name', 'like', '%'.$request->get('name').'%')
                    ->where('description', 'like', '%'.$request->get('description').'%')
                    ->get()->toArray();
        return returnSuccess($data, 'success');
    }
    /**
     * 创建
     */
    public function create (Create $request)
    {
        $role = Role::create($request->all());
        if ($role) {
            return returnSuccess($role, '创建成功');
        }
        return returnFail('', '创建失败');
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
