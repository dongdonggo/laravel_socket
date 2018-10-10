<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/1 0001
 * Time: 下午 4:54
 */

namespace App\handlers\WorkerControllers;



use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\Log;
use App\Model\AdminUser;
use Illuminate\Support\Facades\Validator;

class ConnectController extends RouteController
{
    protected $data;
    protected $client_id;
    public function __construct($data,$client_id)
    {
        $this->data = $data;
        $this->client_id = $client_id;
    }

    /**
     * 链接 注册 client_id
     */
    public function connect()
    {
        # 连接  排队等待 client_id

    }
    /**
     *
     *  认证绑定 client_id
     */
    public function authBind()
    {

        $validate = Validator::make($this->data,[
            'token' => 'required',
            'uuid'  => 'required',
            'type'  => 'required',
        ],[
            'required' => '数据不完整'
        ]);
        if ( $validate->fails() ) {
            $error = $validate->errors();
            $this->error = [
                'status' => false,
                'msg' => json_encode($error)
            ];
            Log::stack(['socket'])->error( json_encode($this->error));
            return [
                'status' => false,
                'data' => $this->error->msg
            ];
        }

        switch ($this->data['type']) {
            case 'custom':  # 客服
                return $this->authAdmin();
                break;
            case 'person': # 用户
                break;

        }

    }

    /**
     * 客服认证
     */
    public function authAdmin()
    {
        $admin = AdminUser::where('uuid',$this->data['uuid'])
            ->where('auth_token',$this->data['token'])
            ->first();
        if (!$admin) {
            Log::stack(['socket'])->error( 'authAdmin,auth fail');
            Gateway::closeClient($this->client_id);
        }
        #  绑定 到客服表数据
        #  区分 已认证 和 未认证 client
        #
        Gateway::bindUid($this->client_id,$admin->id);
        return [
            'status' => true,
            'data' => 'auth success'
        ];
    }
    /**
     *  客服系统
     *  给 client_id 排队。 安排客服
     */
    public  function sortClient()
    {

    }
}
