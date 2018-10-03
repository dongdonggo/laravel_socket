<?php

namespace Tests\Feature;

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
        $pid=pcntl_fork();
        if($pid==-1){ //进程创建失败
            die('fork child process failure!');
        }

//        $response = $this->get('/');

//        $response->assertStatus(200);
    }
}
