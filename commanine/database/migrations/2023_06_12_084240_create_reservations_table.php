<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_adult');
            $table->integer('reserve_child');
            $table->dateTime('chk_in');
            $table->dateTime('chk_out');
            $table->timestamps();
            $table->softDeletes();
            $table->char('reserve_flg',1)->default('0');
            $table->string('reserve_name',30);
            $table->char('reserve_num',11);
            $table->string('user_request',1000)->nullable();
            $table->integer('user_id');
            $table->integer('room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
