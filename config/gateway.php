<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/3 0003
 * Time: 下午 4:43
 */
return [
    'socketPort' => '44444',
    'tcpPort' => '55555',
    'pingData' => '{"type":"ping"}',  #心跳包数据
    'registerAddress' => '127.0.0.1:1236', #消息注册地址
    'eventHandler' => '\handlers\GatewayHandler',  # 消息回调监听
    'count' => 4,    #gateway进程数 cpu 核心数
    'pingInterval' => 10, #心跳间隔
    'routes' => [
        'user' => [
            'sendmsg' => 'MessageController@sendmsg',
            'sendfriend'=> '', #发送给好友
            'sendgroup'=> '', #发送给群
        ]
    ]
    ];