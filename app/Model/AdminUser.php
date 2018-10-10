<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class AdminUser extends Model
{
    protected $guarded = []; //不被批量赋值 空为全部可以赋值
    //
    public static function boot()
    {
        parent::boot();
        #重写 creating
        static::creating(function($model){
            $model->uuid = Uuid::generate()->string;
            $model->password = bcrypt($model->password);
            $model->auth_token = makeAuthToken();
            $model->type = $model->type? $model->type: 1;
        });

        #重写 创建之后的回调钩子
        static::created(function($model)
        {

        });
    }

    /**
     * 用户的角色
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'admin_user_roles','ausers_id','aroles_id');
    }

    /**
     * user 用户
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'custom_messages', 'ausers_id','users_id')
            ->withPivot('message','created_at','updated_at');
    }
}
