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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_name', 100);
            $table->string('room_content', 100);
            $table->string('room_price', 10);
            $table->integer('room_min');
            $table->integer('room_max');
            $table->dateTime('chk_in');
            $table->dateTime('chk_out');
            $table->string('room_detail', 100);
            $table->string('room_facility', 100);
            $table->integer('hotel_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
