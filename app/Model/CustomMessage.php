<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomMessage extends Model
{
    protected $guarded =[];

    public function add($adminid,$userid,$message)
    {
       return static::create([
                'ausers_id' => $adminid,
                'users_id' => $userid ,
                'message' => $message,
            ]);
    }
}
