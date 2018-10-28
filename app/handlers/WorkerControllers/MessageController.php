<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/1 0001
 * Time: 下午 4:54
 */

namespace App\handlers\WorkerControllers;


use App\Model\CustomMessage;
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
        if (strlen($this->data['sendto']) < strlen($this->data['from'])) {
            app(CustomMessage::class)->add($this->data['sendto'], $this->data['from'], $this->data['data']['msg'], $this->data['sendto']);
        } else {
            app(CustomMessage::class)->add($this->data['from'], $this->data['sendto'], $this->data['data']['msg'], $this->data['sendto']);
        }

       return [
           'status' => true,
           'data' => $this->data['data']['msg']
       ];
    }

}
