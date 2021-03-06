<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomMessage extends Model
{
    protected $guarded =[];
    #添加
    public function add($adminid,$personid,$message,$to)
    {
       return static::create([
                'ausers_id' => $adminid,
                'person_id' => $personid ,
                'to' => $to,
                'message' => $message,
            ]);
    }

    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'ausers_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'person_id');
    }

}
