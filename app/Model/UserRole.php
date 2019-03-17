<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //protected $table = '';
    //protected $primaryKey='';
    //public $incrementing = false //使用非递增或者非数字的主键设置false
    //public $timestamps = false; //关闭自动时间维护
    //protected $fillable = ['']; //可被批量赋值
    //protected $dates = ['deleted_at'];
    protected $guarded = []; //不被批量赋值 空为全部可以赋值

    protected $defaultRoleid = 1; # 默认注册用户 角色id
    /**
     * 初始化用户角色
     */
    public function initRole($usersid)
    {
     $userRole = UserRole::create([
            'users_id' => $usersid,
            'roles_id' => $this->defaultRoleid,
        ]);
     return $userRole;
    }
}
