<?php

namespace App\Console\Commands;

use \Workerman\Worker;
use GatewayWorker\BusinessWorker;
use GatewayWorker\Register;
use Illuminate\Console\Command;
use \GatewayWorker\Gateway as Lgateway;

class Gateway extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gateway {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'gateway init socket tcp reg';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arg = $this->argument('action');
        switch ($arg) {
            case 'init':
                $this->business();
                break;
            case 'socket':
                $this->gatewaySocket();
                break;
            case 'reg':
                $this->register();
                break;
            case 'tcp':
                $this->gatewayTcp();
                break;
            case 'udp':
                $this->gatewayUdp();
                break;
            case 'stop':
                break;
            case 'restart':
                break;
            case 'reload':
                break;
            case 'status':
                break;
            case 'connections':
                break;
        }
    }

    public function business()
    {
        // bussinessWorker 进程
        $worker = new BusinessWorker();
        // worker名称
        $worker->name = 'AppBusinessWorker';
        // bussinessWorker进程数量
        $worker->count = config('gateway.count');
        // 服务注册地址
        $worker->registerAddress = config('gateway.registerAddress');
        $worker->eventHandler=  config('gateway.eventHandler');
        // 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START'))
        {
            Worker::runAll();
        }
    }

    # socket
    public function gatewaySocket()
    {

// gateway 进程，这里使用socket协议，可以用telnet测试
        $gateway = new Lgateway("Websocket://0.0.0.0:".config('gateway.socketPort'));

// gateway名称，status方便查看
        $gateway->name = 'socket';
// gateway进程数 cpu 核心数
        $gateway->count = config('gateway.count');
// 本机ip，分布式部署时使用内网ip
        $gateway->lanIp = '127.0.0.1';
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口  提供给 BusinessWorker 通讯
        $gateway->startPort = 2901;
        // 服务注册地址
        $gateway->registerAddress = config('gateway.registerAddress');

        // 心跳间隔
        $gateway->pingInterval = config('gateway.pingInterval');
        // 心跳数据
        $gateway->pingData = config('gateway.pingData');

        /*
        // 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
        $gateway->onConnect = function($connection)
        {
            $connection->onWebSocketConnect = function($connection , $http_header)
            {
                // 可以在这里判断连接来源是否合法，不合法就关掉连接
                // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
                if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
                {
                    $connection->close();
                }
                // onWebSocketConnect 里面$_GET $_SERVER是可用的
                // var_dump($_GET, $_SERVER);
            };
        };
        */

// 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START'))
        {
            Worker::runAll();
        }

    }

    #tcp
    public function gatewayTcp()
    {
        // gateway 进程，这里使用Text协议，可以用telnet测试
        $gateway = new Lgateway("tcp://0.0.0.0:".config('gateway.tcpPort'));

// gateway 进程，这里使用socket协议，可以用telnet测试
//$gateway = new Gateway("Websocket://0.0.0.0:44444");

// gateway名称，status方便查看
        $gateway->name = 'Gateway';
// gateway进程数 cpu 核心数
        $gateway->count = config('gateway.count');
// 本机ip，分布式部署时使用内网ip
        $gateway->lanIp = '127.0.0.1';
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口  提供给 BusinessWorker 通讯 不能和其他协议相同
        $gateway->startPort = 2900;
        // 服务注册地址
        $gateway->registerAddress = config('gateway.registerAddress');

        // 心跳间隔
        $gateway->pingInterval = config('gateway.pingInterval');
        // 心跳数据
        $gateway->pingData = config('gateway.pingData');

        /*
        // 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
        $gateway->onConnect = function($connection)
        {
            $connection->onWebSocketConnect = function($connection , $http_header)
            {
                // 可以在这里判断连接来源是否合法，不合法就关掉连接
                // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
                if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
                {
                    $connection->close();
                }
                // onWebSocketConnect 里面$_GET $_SERVER是可用的
                // var_dump($_GET, $_SERVER);
            };
        };
        */

// 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START'))
        {
            Worker::runAll();
        }
    }

    #udp
    public function gatewayUdp()
    {
        // gateway 进程，这里使用Text协议，可以用telnet测试
        $gateway = new Gateway("udp://0.0.0.0:66666");

// gateway 进程，这里使用socket协议，可以用telnet测试
//$gateway = new Gateway("Websocket://0.0.0.0:44444");

// gateway名称，status方便查看
        $gateway->name = 'Gateway';
// gateway进程数 cpu 核心数
        $gateway->count = 4;
// 本机ip，分布式部署时使用内网ip
        $gateway->lanIp = '127.0.0.1';
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口  提供给 BusinessWorker 通讯 不能和其他协议相同
        $gateway->startPort = 2902;

        // 服务注册地址
        $gateway->registerAddress = config('gateway.registerAddress');

        // 心跳间隔
        $gateway->pingInterval = config('gateway.pingInterval');
        // 心跳数据
        $gateway->pingData = config('gateway.pingData');

        /*
        // 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
        $gateway->onConnect = function($connection)
        {
            $connection->onWebSocketConnect = function($connection , $http_header)
            {
                // 可以在这里判断连接来源是否合法，不合法就关掉连接
                // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
                if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
                {
                    $connection->close();
                }
                // onWebSocketConnect 里面$_GET $_SERVER是可用的
                // var_dump($_GET, $_SERVER);
            };
        };
        */

// 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START'))
        {
            Worker::runAll();
        }

    }

    #register
    public function register()
    {
        // register 必须是text协议
        $register = new Register('text://'.config('gateway.registerAddress'));

// 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START'))
        {
            Worker::runAll();
        }
    }
}
