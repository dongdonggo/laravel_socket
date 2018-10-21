<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/3 0003
 * Time: 下午 5:53
 */

if (!function_exists('msgReturn')) {
    /**
     * @param $data
     * @param null $to_client_id 发给的client_id
     * @param string $from_client_id 来自的client_id, 默认为系统
     * @param string $type  error,close
     * @param string $msg
     * @param bool $status   成功还是失败的 返回数据
     * @throws Exception
     */
    function msgReturn ($data, $to_client_id = null, $from_client_id = 'sys', $type = 'default', $msg = 'success', $status = true)
    {
        $res = [
            'sign' => 123482365,
            'type' => $type,
            'data' => $data,
            'status' => $status,
            'to' => $to_client_id? 'all' : $to_client_id,
            'from' => $from_client_id ,
            'msg' => $msg
        ];
        $jsonstr = json_encode($res);
        if (!$to_client_id) {
            \GatewayClient\Gateway::sendToAll($jsonstr);
        } else {
            try{
                \GatewayClient\Gateway::sendToClient($to_client_id, $jsonstr);
            } catch (Exception $exception) {
                \Illuminate\Support\Facades\Log::stack(['scoket'])->error('msgReturn  scoket');
            }

        }
    }
}

if (!function_exists('msgByUid')) {
    /**
     * @param $data
     * @param null $to_uid
     * @param string $from_client_id
     * @param string $type  msginit=> 消息连接初始化
     * @param string $msg
     * @param bool $status
     * @throws Exception
     */
    function msgByUid ($data, $to_uid= null, $from_client_id = 'sys', $type = 'default', $msg = 'success', $status = true)
    {
        $res = [
            'sign' => 123482365,
            'type' => $type,
            'data' => $data,
            'status' => $status,
            'to' => $to_uid? 'all' : $to_uid,
            'from' => $from_client_id ,
            'msg' => $msg
        ];
        $jsonstr = json_encode($res);
        if (!$to_uid) {
            \GatewayClient\Gateway::sendToAll($jsonstr);
        } else {
            try{
                \GatewayClient\Gateway::sendToUid($to_uid, $jsonstr);
            } catch (Exception $exception) {
                \Illuminate\Support\Facades\Log::stack(['scoket'])->error('msgReturn  scoket');
            }

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
    function returnFail ($data,$message, $ercode='500'){
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

