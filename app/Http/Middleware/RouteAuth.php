<?php

namespace App\Http\Middleware;

use App\Model\RoleRoute;
use App\Model\Route;
use App\Model\User;
use App\Model\UserRole;
use Closure;
use Illuminate\Support\Facades\Log;

class RouteAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        # 用户判断【游客，普通用户，后台用户,other】
        $authorization = $request->header('Authorization');
        if (!$authorization) {
            return returnFail('','参数不全header.Authorization');
        }

        try {
            $datajson = decrypt($authorization);
        } catch (\Exception $exception) {
            return returnFail('','token is not find');
        }

        $dataarr = json_decode($datajson, true);
        $user = User::where('uuid', $dataarr['uuid'])->first();
        if (!$user) {
            return returnFail('','token user is not find');
        }
        if ($user->auth_token != $dataarr['auth_token']) {
            return returnFail('', 'token is expire');
        }

        #判断用户角色
        $rolesid = UserRole::where('users_id',$user->id)->pluck('roles_id');
        if ($rolesid) {
            Log::error('用户未绑定角色',['user'=>$user]);
            return returnFail('','用户未激活，数据错误');
        }
        #判断用户是否拥有此权限
         $url = $request->path();
        $routesid = Route::where('action',$url)->pluck('id');

        $exists = RoleRoute::where('roles_id',$rolesid)
                            ->where('routes_id',$routesid)
                            ->first();
        if ($exists) {
            return $next($request);
        }else {
            return returnFail('', '没有权限');
        }
    }
}
