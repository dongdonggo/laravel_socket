<?php

namespace handlers;

use App\Models\User;
use Workerman\Lib\Timer;

// 心跳间隔10秒
define('HEARTBEAT_TIME', 10);

class WorkermanHandler
{
    // 处理客户端连接
    public function onConnect($connection)
    {
        echo $connection->id;
        echo "new connection from ip " . $connection->getRemoteIp() . "\n";
    }

    // 处理客户端消息
    public function onMessage($connection, $data)
    {
//        $user = User::find(1)->toArray();
        // 向客户端发送hello $data
        $connection->send('Hello, your send message is: '.$data );
    }

    // 处理客户端断开
    public function onClose($connection)
    {
        echo "connection closed from ip {$connection->getRemoteIp()}\n";
    }

    public function onWorkerStart($worker)
    {
        Timer::add(1, function () use ($worker) {
            $time_now = time();
            foreach ($worker->connections as $connection) {
                // 有可能该connection还没收到过消息，则lastMessageTime设置为当前时间
                if (empty($connection->lastMessageTime)) {
                    $connection->lastMessageTime = $time_now;
                    continue;
                }
                // 上次通讯时间间隔大于心跳间隔，则认为客户端已经下线，关闭连接
                if ($time_now - $connection->lastMessageTime > HEARTBEAT_TIME) {
                    echo "Client ip {$connection->getRemoteIp()} timeout!!!\n";
                    $connection->close();
                }
            }
        });
    }

    #每个连接都有一个单独的应用层发送缓冲区，如果客户端接收速度小于服务端发送速度，
    #数据会在应用层缓冲区暂存，如果缓冲区满则会触发onBufferFull回调
    // 设置当前连接发送缓冲区，单位字节
    //$connection->maxSendBufferSize = 102400;
    public function onBufferFull($worker)
    {

    }

    # 该回调在应用层发送缓冲区数据全部发送完毕后触发
    public function onBufferDrain()
    {

    }

    #当客户端的连接上发生错误时触发。
    public function onError()
    {

    }
}
