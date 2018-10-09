<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/3 0003
 * Time: 下午 5:53
 */

if (!function_exists('msgReturn')) {
    function msgReturn ($data, $client_id = null, $msg = 'success', $status = true)
    {
        $res = [
            'sign' => 123482365,
            'data' => $data,
            'status' => $status,
            'msg' => $msg
        ];
        $jsonstr = json_encode($res);
        if (!$client_id) {
            \GatewayClient\Gateway::sendToAll($jsonstr);
        } else {
            \GatewayClient\Gateway::sendToClient($client_id, $jsonstr);
        }
    }
}

if(!function_exists('returnSuccess')){
    function returnSuccess ($data,$message=''){
        return response([
            'status' => '0',
            'data'=> $data,
            'msg'=> $message,
            'code' => ''
        ], 200);
    }
}

if(!function_exists('returnFail')){
    function returnFail ($data,$message, $ercode){
        return response([
            'status' => '-1',
            'data'=> $data,
            'msg'=> $message,
            'code' => $ercode,
        ],200);
    }
}

if(!function_exists('returnError')){
    function returnError ($data,$message,$ercode, $code) {
        return response([
            'status' => '-1',
            'data'=> $data,
            'msg'=> $message,
            'code' => $ercode,
        ],$code);
    }
}

if (!function_exists('makeAuthToken')) {
    /**
     * 创造权限验证token
     * @return bool|string  md5 16位 不重复加密字符
     */
    function makeAuthToken() {
        return substr(md5(bcrypt(1)), 8, 16);#16位
    }
}

if (! function_exists('viewtest')) {
    function viewtest($data)
    {
        $res =  json_decode($data, true);
        dump($res);
    }
}
