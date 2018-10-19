<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/1 0001
 * Time: 下午 4:54
 */

namespace App\handlers\WorkerControllers;



use GatewayWorker\Lib\Gateway;
use http\Env\Request;
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

        switch ($this->data['type']) {
            case 'custom':  # 后台客服
                $this->dataVa();
                return $this->authAdmin();
                break;
            case 'person': # 用户咨询，无账号绑定，直接排队
                return $this->authUser();
                break;
        }

    }

    /**
     * 数据验证
     */
    public function dataVa()
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
        }
    }

    /**
     * 客服认证
     */
    public function authAdmin()
    {
        if (!$this->error['status']) {
            return [
                'status' => false,
                'data' => $this->error->msg
            ];
        }

        $admin = AdminUser::where('uuid',$this->data['uuid'])
            ->where('auth_token',$this->data['token'])
            ->first();
        if (!$admin) {
            Log::stack(['socket'])->error( 'authAdmin,auth fail');
            Gateway::closeClient($this->client_id);
        }
        
        #  绑定 到客服表数据 

        Gateway::bindUid($this->client_id,$admin->id);
        return [
            'status' => true,
            'data' => 'auth success'
        ];
    }

    /**
     * 绑定用户
     */
    public function authUser()
    {

    }
    /**
     *  客服系统
     *  给 client_id 排队。 安排客服
     */
    public  function sortClient(Request $request)
    {

    }
}
