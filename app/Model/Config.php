<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $guarded = [];//不被批量赋值 空为全部可以赋值
}
