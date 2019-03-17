<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tempuser_id')->comment('临时的用户id ');
            $table->integer('custom_id')->nullable()->comment('等待客服的id');
            $table->integer('status')->default(1)->comment('处理状态: 1 等待中，2，已接待');
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
        Schema::dropIfExists('waits');
    }
}
