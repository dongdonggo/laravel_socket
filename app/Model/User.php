<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class User extends Model
{
    //protected $table = '';
    //protected $primaryKey='';
    //public $incrementing = false //使用非递增或者非数字的主键设置false
    //public $timestamps = false; //关闭自动时间维护
    //protected $fillable = ['']; //可被批量赋值
    //protected $dates = ['deleted_at'];
    protected $guarded = []; //不被批量赋值 空为全部可以赋值
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
            Log::info('新用户创建::>>'.json_encode($model));
            $userRole = app(UserRole::class)->initRole($model->id);
            if ($userRole) {
                Log::info('新用户角色绑定成功::>>'.json_encode($userRole));
            }
        });
    }

    public function roles ()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'users_id', 'roles_id');
    }


    /**
     * auth_token 访问修改器，
     * @param $value
     * @return bool|string
     */
//    public function getAuthTokenAttribute ($value)
//    {
////        return makeAuthToken();
//    }

    /**
     * auth_token 赋值修改器
     * @param $value
     */
//    public function setAuthTokenAttribute ($value)
//    {
////        $this->attributes['auth_token'] = base64_encode($value);
////        dd($this->attributes['auth_token'] );
//    }



}
