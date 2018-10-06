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
