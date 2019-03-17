<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminUserRole extends Model
{
    protected $guarded = []; //不被批量赋值 空为全部可以赋值
    //

    public  function add($arr)
    {
        return static::create($arr);
    }


}
