<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('phone',11)->nullable();
            $table->string('password');
            $table->string('uuid',191)->unique();
            $table->string('auth_token')->comment('api认证token');
            $table->integer('type')->comment('用户身份');
            $table->string('client_id')->nullable()->comment('socket_id');
            $table->integer('online')->default(0)->comment('0 下线，1上线，2 离开');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
