<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ausers_id')->unsigned()->comment('客服id');
            $table->integer('person_id')->unsigned()->comment('咨询者的id');
            $table->integer('to')->unsigned()->comment('接受方id');
            $table->string('message')->comment('内容');
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
        Schema::dropIfExists('custom_messages');
    }
}
