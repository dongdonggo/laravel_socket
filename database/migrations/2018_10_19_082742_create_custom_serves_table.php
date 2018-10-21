<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomServesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 客服正在接待的人
        Schema::create('custom_serves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ausers_id')->unsigned()->comment('客服ID');
            $table->string('person_id')->comment('用户ID or orderid');
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
        Schema::dropIfExists('custom_serves');
    }
}
