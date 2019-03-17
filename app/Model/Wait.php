<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wait extends Model
{
    //

    protected $guarded =[];

    /**
     * 排队添加
     * $client_id ,为 重新连接时，查询到的客服id
     */
    public function add($tempuser_id, $custom_id=null)
    {
      return  static::create([
            'tempuser_id' =>$tempuser_id,
            'custom_id' => $custom_id,
            'status' => 1,
        ]);
    }
}
