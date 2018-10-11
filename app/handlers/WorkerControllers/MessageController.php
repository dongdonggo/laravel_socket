<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/1 0001
 * Time: 下午 4:54
 */

namespace App\handlers\WorkerControllers;


use Illuminate\Support\Facades\Log;

class MessageController
{

    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     *  发送信息
     * send
     */
    public  function sendmsg()
    {
        var_dump($this->data);
       return [
           'status' => true,
           'data' => $this->data['msg']
       ];
    }

}
