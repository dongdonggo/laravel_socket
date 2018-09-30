<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;


/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{

    public function __construct()
    {
        //加载index文件的内容
        require __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../bootstrap/app.php';
    }

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
     /*   $_POST['data'] = ['client_id'=>$client_id,'type'=>'connnect'];
        $_SERVER = [
            "DOCUMENT_ROOT"=>"D=>\\IDE\\PHPTutorial\\WWW\\laravel_socket\\public",
            "REMOTE_ADDR"=>"127.0.0.1",
            "REMOTE_PORT"=>"53290",
            "SERVER_SOFTWARE"=>"PHP 7.1.13 Development Server",
            "SERVER_PROTOCOL"=>"HTTP\/1.1",
            "SERVER_NAME"=>"127.0.0.1",
            "SERVER_PORT"=>"8000",
            "REQUEST_URI"=>"\/ccc\/bb",
            "REQUEST_METHOD"=>"GET",
            "PATH_INFO" => "\/ccc\/bb",
            "SCRIPT_NAME"=>"\/index.php",
            "SCRIPT_FILENAME"=>"D=>\\IDE\\PHPTutorial\\WWW\\laravel_socket\\public\\index.php",
            "PHP_SELF"=>"\/index.php",
            "HTTP_HOST"=>"127.0.0.1=>8000",
            "HTTP_CONNECTION"=>"keep-alive",
            "HTTP_UPGRADE_INSECURE_REQUESTS"=>"1",
            "HTTP_USER_AGENT"=>"Mozilla\/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit\/537.36 (KHTML,like Gecko) Chrome\/69.0.3497.100Safari\/537.36",
            "HTTP_ACCEPT"=>"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8",
            "HTTP_ACCEPT_ENCODING"=>"gzip,deflate,br",
            "HTTP_ACCEPT_LANGUAGE"=>"zh-CN,zh;q=0.9",
            "HTTP_COOKIE"=>"hblid=lsfnACjdTQC6VKkt3m39N0HaB5orAbY2; olfsk=olfsk7813509245504264",
            "REQUEST_TIME_FLOAT"=>1538213347.372128,
            "REQUEST_TIME"=>1538213347
        ];
        ob_start();//启用缓存区
        require __DIR__.'/../vendor/autoload.php';
        $app = require_once __DIR__.'/../bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
        $response = $kernel->handle(
            $request = Illuminate\Http\Request::capture()
        );
        $response->send();
        $kernel->terminate($request, $response);
        $res = ob_get_contents();//获取缓存区的内容
        ob_end_clean();//清除缓存区*/

        // 向当前client_id发送数据
        Gateway::sendToClient($client_id, 'ss');
        // 向所有人发送
        Gateway::sendToAll("$client_id login\r\n");
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {

       $_POST['data'] = [
           'client_id'=>$client_id,
           'type'=>'message',
           'msg'=>$message
       ];
        $_SERVER = [
           "DOCUMENT_ROOT"=>"D=>\\IDE\\PHPTutorial\\WWW\\laravel_socket\\public",
           "REMOTE_ADDR"=>"127.0.0.1",
           "REMOTE_PORT"=>"53290",
           "SERVER_SOFTWARE"=>"PHP 7.1.13 Development Server",
           "SERVER_PROTOCOL"=>"HTTP\/1.1",
           "SERVER_NAME"=>"127.0.0.1",
           "SERVER_PORT"=>"8000",
           "REQUEST_URI"=>"\/ccc\/bb",
           "REQUEST_METHOD"=>"GET",
           "PATH_INFO" => "\/ccc\/bb",
           "SCRIPT_NAME"=>"\/index.php",
           "SCRIPT_FILENAME"=>"D=>\\IDE\\PHPTutorial\\WWW\\laravel_socket\\public\\index.php",
           "PHP_SELF"=>"\/index.php",
           "HTTP_HOST"=>"laravel.test.local",
           "HTTP_CONNECTION"=>"keep-alive",
           "HTTP_UPGRADE_INSECURE_REQUESTS"=>"1",
           "HTTP_USER_AGENT"=>"Mozilla\/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit\/537.36 (KHTML,like Gecko) Chrome\/69.0.3497.100Safari\/537.36",
           "HTTP_ACCEPT"=>"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8",
           "HTTP_ACCEPT_ENCODING"=>"gzip,deflate,br",
           "HTTP_ACCEPT_LANGUAGE"=>"zh-CN,zh;q=0.9",
           "HTTP_COOKIE"=>"hblid=lsfnACjdTQC6VKkt3m39N0HaB5orAbY2; olfsk=olfsk7813509245504264",
           "REQUEST_TIME_FLOAT"=>1538213347.372128,
           "REQUEST_TIME"=>1538213347,
//            'argv'=>123,
       ];
       ob_start();//启用缓存区
       require __DIR__.'/../vendor/autoload.php';
//       $app = require_once __DIR__.'/../bootstrap/app.php';


       $app = new Illuminate\Foundation\Application(
           realpath(__DIR__.'/../')
       );

///////////////////////////////////////////////////////////////////////////
///////////////////////       注册核心文件       ////////////////////////////
///////////////////////////////////////////////////////////////////////////
       #  请求
       $app->singleton(
           Illuminate\Contracts\Http\Kernel::class,
           App\Http\Kernel::class
       );
        # 命令行
    /*   $app->singleton(
           Illuminate\Contracts\Console\Kernel::class,
           App\Console\Kernel::class
       );*/
        # 异常---
       $app->singleton(
           Illuminate\Contracts\Debug\ExceptionHandler::class,
           App\Exceptions\Handler::class
       );



       $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
       $response = $kernel->handle(
           $request = Illuminate\Http\Request::capture()
       );
//       $response->send();
//       $kernel->terminate($request, $response);

//       $user = App\Models\User::find(1);
//       $res = response($user);
//       dump($user);
       $res = ob_get_contents();//获取缓存区的内容
       ob_end_clean();//清除缓存区

        // 向所有人发送
        Gateway::sendToAll($res);
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
       // 向所有人发送 
       GateWay::sendToAll("$client_id logout\r\n");
   }
}
