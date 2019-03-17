<?php

namespace App\Http\Controllers;

use App\Model\Config;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Kra8\Snowflake\Snowflake;

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

    public function testa(Request $request)
    {
/*
        $snowflake = app(Snowflake::class);
        $id = $snowflake->next();*/
        return view('chat.chat');

    }

    public function testva(Request $request)
    {
//       $request->sometimes(['country_id','brand_id','modelpn_id'], 'required|numeric', function ($input) {
//            $configs = Config::query()->where([
//                'brand_id' => $input->brand_id,
//                'modelpn_id' => $input->modelpn_id,
//                'country_id' => $input->country_id
//            ])->first();
//            return $configs?false:true;
//        });
        $where = [
            'brand_id' => $request->get('brand_id'),
            'modelpn_id' => $request->get('modelpn_id'),
        ];
        $this->validate($request,[
            "country_id" => [
                "required",
                Rule::unique('configs')
                    ->where(function($query) use($where){
                        return $query->where($where);
                    })
            ]
        ]);

       $request->validate([ 
         "country_id" => [
             "required",
             Rule::unique('configs')
                 ->where(function($query) use($where){
                     return $query->where($where);
                 })
             ]
       ]);
//select count(*) as aggregate from `configs` where `country_id` = '1' and ((`brand_id` = '2' and `modelpn_id` = '1'))

//        $v = Validator::make($request->all(),[
//            "country_id" => [
//                "required",
//                Rule::unique('configs')
//                    ->where(function($query) use($where){
//                        return $query->where($where);
//                    })
//            ]
//        ]);
//       $log = DB::getQueryLog();
//       dump($log);
//        if($v->fails()){
//            echo  returnFail( $v->errors(),'sss');
//        }
//        echo 'success';

        return view('chat.chat');
    }


}
