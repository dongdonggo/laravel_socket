<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomMessage extends Model
{
    protected $guarded =[];
    #添加
    public function add($adminid,$userid,$message)
    {
       return static::create([
                'ausers_id' => $adminid,
                'users_id' => $userid ,
                'message' => $message,
            ]);
    }

    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'ausers_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
