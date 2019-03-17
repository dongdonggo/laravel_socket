<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aroutes_id')->unsigned()->comment('路由权限id');
            $table->integer('aroles_id')->unsigned()->comment('角色id');
            $table->foreign('aroutes_id')->references('id')->on('admin_routes');
            $table->foreign('aroles_id')->references('id')->on('admin_roles');
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
        Schema::dropIfExists('admin_role_routes');
    }
}
