<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Model\RoleRoute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleRouteController extends Controller
{
    /**
     * 给角色分配路由
     */
    public function create (Request $request) 
    {
            $request->validate([
                'routes_id' => 'required|exists:routes,id',
                'roles_id' => 'required|exists:role,id',
            ],[
                'required' => ':attribute 参数未填完整',
                'exists' => ':attribute 数据错误'
            ]);

            $roleRoute = RoleRoute::where('routes_id',$request->get('routes_id'))
                ->where('roles_id', $request->get('roles_id'))
                ->first();
            if ($roleRoute) {
                return returnFail('', '数据已存在，请勿重复创建');
            }
            $create = RoleRoute::create($request->all());
            if ($create) {
                return returnSuccess($create, '数据创建成功');
            }
            return returnFail('', '数据创建失败');
    }
    /**
     * 删除
     */
    public function delete (Request $request)
    {
        $request->validate([
            'id' => 'required|exists:role_routes,id',
        ],[
            'required' => ':attribute 参数未填完整',
            'exists' => ':attribute 数据错误'
        ]);
        $roleRoute = RoleRoute::find($request->get('id'));
        $result = $roleRoute->delete();
        if ($result) {
            return returnSuccess($result, '删除成功');
        }
        return returnFail('', '删除失败');
    }
}
