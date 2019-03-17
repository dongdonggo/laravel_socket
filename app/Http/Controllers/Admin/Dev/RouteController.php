<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Http\Requests\Admin\Dev\Route\CreatePost;
use App\Http\Requests\Admin\Dev\Route\DeletePost;
use App\Http\Requests\Admin\Dev\Route\UpdatePost;
use App\Model\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    /**
     * 搜素查询上
     */
    public function show (Request $request)
    {
        $data = Route::where('name','like','%'.$request->get('name'))
            ->where('action', 'like', '%'.$request->get('action').'%')
            ->get()->toArray();
        return returnSuccess($data,'success');
    }
    /**
     * 创建
     */
    public function create (CreatePost $request)
    {
        $route = Route::create($request->all());
        if ($route) {
            return returnSuccess($route, '创建成功');
        }
        return returnFail('', '创建失败');
    }

    /**
     * 修改
     */
    public function update (UpdatePost $request)
    {
        $route = Route::where('id',$request->get('id'))->update($request->all());
        if ($route) {
            return returnSuccess($route, '操作成功');
        }
        return returnFail('', '操作失败');
    }

    /**
     * 删除
     */
    public function delete(DeletePost $request)
    {
        $route = Route::find($request->get('id'));
        $result = $route->delete();
        if ($result) {
            return returnSuccess($result, '删除成功');
        }
        return returnFail('', '删除失败');
    }
}
