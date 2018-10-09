<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ausers_id')->unsigned()->comment('用户id');
            $table->integer('aroles_id')->unsigned()->comment('角色id');
            $table->foreign('aroles_id')->references('id')->on('admin_roles');
            $table->foreign('ausers_id')->references('id')->on('admin_users');
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
        Schema::dropIfExists('admin_user_roles');
    }
}
