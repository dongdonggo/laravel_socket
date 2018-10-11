<?php

namespace Tests\Feature;

use GatewayClient\Gateway;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
//        start "C:\Windows\System32\cmd.exe"
        $res = Gateway::getUidByClientId('7f0000010b550000001a');
        dump($res);
    }

    /**
     * 添加管理员
     */
    public function testAdminadd()
    {
        $response = $this->get('/admin/dev/users/adduser',[
            'username' => 'dongodng',
            'password' => 'sdfdsf',
            'type' => 2,
        ]);
        viewtest($response->getContent());
        $response->assertStatus(200);
    }
}
