<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/3 0003
 * Time: 下午 10:26
 */

namespace App\handlers\WorkerControllers;


use GatewayWorker\Lib\Gateway;
use http\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class RouteController
{
    /**
     *  接受的数据, 数组
     * @var
     */
    protected  $data;
    protected  $uid; # 绑定的用户id
    protected  $error = ['status'=>true,'msg'=>'no error']; #运行抛出的错误
    protected  $response; # 处理完成返回的数据
    protected  $route; #  访问的路由
    protected  $accept_client_id; # 访问的 client_id
    protected  $send_client_id = null; # 发送的 client_id null 为发送所有人;
    public function __construct()
    {

    }

    /**
     * routes 路由
     */
    private function routes()
    {
        $routes = config('gateway.routes');
       /* if (!$routes) {
            $this->error = [
                'status' => false,
                'msg' => 'server router auth is empty'
            ];
            Log::stack('socket')->error(json_encode($this->error));
        } */
        return $routes;
    }

    /**
     * 初始化
     */
    public function init($client_id,$data,$uid)
    {
        $this->accept_client_id = $client_id;
        $this->uid = $uid;
        $this->dataValidate($data); #数据验证
        $this->routeValidate(); #验证
        $this->routeResolution(); #路由执行

        # 数据正确性验证
         /*
          {
            # 数据格式验证
            # 安全过滤 验证
            # 签名验证
            # 路由验证
           }
         */
        # 路由执行。
        # 返回数据格式 ，大小 验证
        # 返回值
        if ( !$this->isError() ) {
            $this->send_client_id = $this->accept_client_id;
           msgReturn('',  $this->send_client_id,  $this->error['msg'], false);
        } else {
            msgReturn($this->response, $this->send_client_id);
        }
    }

    /**
     * 是否有错误信息抛出
     */
    public function isError()
    {
        if ( $this->error['status'] ) {
            return true;
        }
        return false;
    }
    /**
     * 处理后返回数据根式是否正确
     */
    public function isFormat(array $res)
    {
        $validate = Validator::make($res, [
            'data' => 'required',
            'status' => 'required',
        ],[
            'required' => "返回数据格式不正确 ['data'=>'','status'=>'']"
        ]);
        if( $validate->fails() ) {
            $error = $validate->errors();
            $this->error = [
                'status' => false,
                'msg' => json_encode($error)
            ];
            Log::stack(['socket'])->error( json_encode($this->error));
            return false;
        } else {
            return true;
        }
    }

    /**
     * 数据验证
     */
    public function dataValidate($data)
    {
        $arr = json_decode($data, true);
        $validate = Validator::make($arr, [
            'data' => 'required',
            'sign' => 'required',
            'action' => 'required',
        ],[
            'required' => '数据不完整'
        ]);
        if( $validate->fails() ) {
            $error = $validate->errors();
            $this->error = [
                'status' => false,
                'msg' => json_encode($error)
            ];
            Log::stack(['socket'])->error( json_encode($this->error));
        } else {
            $this->data = $arr;
        }
    }

    /**
     *路由验证
     */
    public function  routeValidate()
    {
        if ( !$this->isError() ) {
            return ;
        }
        $routes = $this->routes();
        $routestr = $this->data['action'];
        $explode = explode('/', $routestr);
        if ( count($explode) != 2 ) {
            $this->error = [
              'status' => false,
              'msg' => 'route is error '.$routestr,
            ];
            Log::stack(['socket'])->info(json_encode($this->error));
            return ;
        } else {

            $this->route = isset($routes[$explode[0]][$explode[1]])?$routes[$explode[0]][$explode[1]]:null;
            if ( !$this->route ) {
                $this->error = [
                    'status' => false,
                    'msg' => $routestr.' is  auth error',
                ];
                Log::stack(['socket'])->error(json_encode($this->error));
            }
            # 路由权限uid认证
            $this->routeValidateUid();
        }

    }

    /**
     * 路由 验证之 uid
     */
    public function routeValidateUid()
    {
        if (!$this->isError()) {
            return ;
        }

        if (!$this->uid) {
            $routes = $this->routes();
            $default = $routes['default'];
            if ($this->route != $default) {
                Gateway::closeClient($this->accept_client_id);
            }
        }
    }
    /**
     * 路由解析 执行
     */
    public function routeResolution()
    {
        if ( ! $this->isError() ) {
            return ;
        }
        $arr = explode('@', $this->route);

        $class = new \ReflectionClass(__NAMESPACE__.'\\'.$arr[0]);
        if ($class->hasMethod($arr[1])) {
            $obj = $class->newInstance ($this->data['data'], $this->accept_client_id);
            $classMethod = new \ReflectionMethod(__NAMESPACE__.'\\'.$arr[0], $arr[1]);
            $res = $classMethod ->invoke($obj,$arr[1],$this->data['data']);
            $this->resDataCase($res);
        } else {
            $this->error = [
                'status' => false,
                'msg' => $this->route.'  is not exists'
            ];
            Log::stack(['socket'])->error($this->route.'  is not exists');
        }

    }

    /**
     * 逻辑处理后台返回数据处理
     */
    public function resDataCase(array $res)
    {
        if($this->isFormat($res)) {
            $res['status'] ? ($this->response = $res['data']) : ($this->error = $res['data']);
        }
    }
    
    /**
     * 安全过滤
     */
    public function safeFilter($data)
    {

    }

    /**
     * 签名验证
     * 参数验证
     */
    public function  signValidate($data)
    {

    }



}
