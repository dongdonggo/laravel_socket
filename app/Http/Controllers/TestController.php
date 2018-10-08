<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $user = User::first();
        if ($user) {
            $reauth_token = makeAuthToken();#16位
            $user->auth_token = $reauth_token;
            $user->save();
            # 此token 可加入 用户浏览器数据，ip 等。 权限验证是进行验证
            $data = [
                 'uuid' => $user->uuid,
                 'auth_token' => $reauth_token
            ];
            $authorization = encrypt(json_encode($data));
        }
        return returnSuccess(['Authorization'=>$authorization],'token ok');
    }

    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'bail|required|unique:users|max:11',
            'password' => 'required',
            'name' => 'required'
        ],[
            'phone.unique' => '账号已存在',
            'required' => '请填写完整',
        ]);
        $user =  User::create($request->all());
        if ($user) {
            return returnSuccess($user,'success');
        }
    }


}
