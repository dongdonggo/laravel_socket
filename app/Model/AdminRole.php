<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $guarded = []; //不被批量赋值 空为全部可以赋值
    # role 客服角色 id
    static protected $custom = 5;
    public function getCustomId()
    {
        return $this->custom;
    }
    public function getall()
    {
        return AdminRole::get();
    }

    public function users()
    {
        return $this->belongsToMany(AdminUser::class, 'admin_user_roles', 'aroles_id','ausers_id');
    }
}
