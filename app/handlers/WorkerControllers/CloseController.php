<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/1 0001
 * Time: 下午 4:55
 */

namespace App\handlers\WorkerControllers;


class CloseController
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}
