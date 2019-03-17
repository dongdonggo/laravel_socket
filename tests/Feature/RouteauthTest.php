<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webpatser\Uuid\Uuid;

class RouteauthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testreg()
    {
        $response = $this->json('get', '/reg', [
            'name' => 'dongdong',
            'phone' => '18190665889',
            'password' => '123',
        ]);
        dump($response->getContent());
        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $response = $this->json('get', '/index', [], [
            'Authorization' => 'eyJpdiI6Ilp6RFlaRm9HUU9vcEx6SjZZRkpKaVE9PSIsInZhbHVlIjoibVFiNFBnM3pzXC9RVHQ0dmhvOGtzTEhXblJsenhBZDJuVlFtS1k1UzBlaXZcL2s5NVNGdjBobE9xWDNFR09wR2g5ZnNEWjRXQSsyN3VqeUhURTFEVmRQSUgyaGJ3RlRLN3A1TlFDUlh0c3kyc1NVNEpXNXljdWpFRFBlZHVMZ2ZKWSIsIm1hYyI6ImFkOWIzMmQ4MjU1NGUzNWNhN2ZhMzhmODgzZDllNzQxNGUzZDliNGUwYjZiNGZlMjEwMjNlOTBlZjZjNzEwYTYifQ'
        ]);
        dump($response->getContent());
        $response->assertStatus(200);

    }
#----------------------------------------------------------------------

    /**
     * role 角色创建
     */
    public function testAdminDev()
    {
        $response = $this->json('post', '/admin/dev/role/create', [
            'name' => '维护人员',
            'description' => '管理平台维护',
        ], [
            'Authorization' => 'eyJpdiI6IjF5TEZZREY2WElVOUF2RHBEUnRaWFE9PSIsInZhbHVlIjoiclhLNDJDYU1mNVU2V0ZkdjlhTGc1Ymo0ZWZVRnNzeXNoSktOVzB1VGhDV3NCZitvVDBuMzl4M05TNTdOY0ZQTUl6eG95SGZwZklDYXF2SitadFgyQUxEWThwZ0NPTmdGbm1WUUJJa250Sjdwa3dpdnZpWFIrN0FxSzZiWjl6N0EiLCJtYWMiOiIwNDJjOTIyMjc0ZWRkMjM0YmYyNmQ2OWVmMzcxNjdlZTA0Zjk1ZDc0MmE0NzMyZmUzMzk3OTUwMDYzYTdjNDBkIn0'
        ]);
        dump(json_decode($response->getContent()));
        $response->assertStatus(200);

    }

    /**
     * 角色更新
     */
    public function testAdminDevupdate()
    {
        $response = $this->json('post', '/admin/dev/role/update', [
            'id' =>1,
            'name' => '普通用户',
            'description' => '用户',
        ], [
            'Authorization' => 'eyJpdiI6IjF5TEZZREY2WElVOUF2RHBEUnRaWFE9PSIsInZhbHVlIjoiclhLNDJDYU1mNVU2V0ZkdjlhTGc1Ymo0ZWZVRnNzeXNoSktOVzB1VGhDV3NCZitvVDBuMzl4M05TNTdOY0ZQTUl6eG95SGZwZklDYXF2SitadFgyQUxEWThwZ0NPTmdGbm1WUUJJa250Sjdwa3dpdnZpWFIrN0FxSzZiWjl6N0EiLCJtYWMiOiIwNDJjOTIyMjc0ZWRkMjM0YmYyNmQ2OWVmMzcxNjdlZTA0Zjk1ZDc0MmE0NzMyZmUzMzk3OTUwMDYzYTdjNDBkIn0'
        ]);
        dump(json_decode($response->getContent()) );
        $response->assertStatus(200);
    }

    /**
     * 角色删除
     */
    public function testAdminDevdelete()
    {
        $response = $this->json('post', '/admin/dev/role/delete', [
            'id' => 8,
        ], [
            'Authorization' => 'eyJpdiI6IjF5TEZZREY2WElVOUF2RHBEUnRaWFE9PSIsInZhbHVlIjoiclhLNDJDYU1mNVU2V0ZkdjlhTGc1Ymo0ZWZVRnNzeXNoSktOVzB1VGhDV3NCZitvVDBuMzl4M05TNTdOY0ZQTUl6eG95SGZwZklDYXF2SitadFgyQUxEWThwZ0NPTmdGbm1WUUJJa250Sjdwa3dpdnZpWFIrN0FxSzZiWjl6N0EiLCJtYWMiOiIwNDJjOTIyMjc0ZWRkMjM0YmYyNmQ2OWVmMzcxNjdlZTA0Zjk1ZDc0MmE0NzMyZmUzMzk3OTUwMDYzYTdjNDBkIn0'
        ]);
        dump(json_decode($response->getContent()) );
        $response->assertStatus(200);
    }

    # role show 角色搜索

    /**
     * 角色搜索  role show
     */
    public function testRoleShow()
    {
        $response = $this->json('get', '/admin/dev/role/show', [
            'name' => '管理'
        ]);
//        dump($response->getContent());
        $response->assertStatus(200);
    }

    /**
     * userrolequery 用戶角色查詢
     *
     */
    public function testuserrolequery()
    {
        $response = $this->json('post', '/admin/dev/role/userrolequery', [
            'users_id' => '2'
        ]);
        dump(json_decode($response->getContent(), true));
        $response->assertStatus(200);
    }

    ##############################################################
    ##                     路由api测试                            ##
    ##                        !!!!!!!!                          ##
    #############################################################

    /**
     *路由创建
     */
    public function testRoutecreate()
    {
        $response = $this->json('post', '/admin/dev/route/create', [
            'name' => '创建角色',
            'action' => '/admin/dev/role/crate',
            'description' => '创建角色'
        ]);
        dump(json_decode($response->getContent()));
        $response->assertStatus(200);
    }

    /**
     * 路由修改
     */
    public function testRouteUpdate()
    {
        $response = $this->json('post', 'admin/dev/route/update', [
            'id' => '3',
            'name' => '删除路由',
            'description' => '删除路由'
        ]);
        dump(json_decode($response->getContent()));
        $response->assertStatus(200);
    }

    /**
     * 路由删除
     */
    public function testRoutedelete()
    {
        $response = $this->json('post', 'admin/dev/route/delete', [
            'id' => 45
        ]);
        dump(json_decode($response->getContent()));
        $response->assertStatus(200);
    }

    /**
     * userrole/createorupdate  给用户分配角色
     *
     */
    public function testUserRoleRoute ()
    {

        $respon  = $this->json('post', 'admin/dev/userrole/createorupdate', [
           'users_id' => 2,
            'roles_id' => 2
        ]);
        dump(json_decode($respon->getContent()));
        dump($respon->getStatusCode());
        $respon->assertStatus(200);
    }
}
