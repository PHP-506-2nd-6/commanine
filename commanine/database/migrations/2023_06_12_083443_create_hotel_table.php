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
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hotel_name', 100);
            $table->string('hotel_local', 30);
            $table->string('hotel_coment', 300);
            $table->string('hotel_addr', 200);
            $table->string('longitude', 30);
            $table->string('latitude', 30);
            $table->char('hotel_num', 11);
            $table->string('hotel_info', 1000);
            $table->string('hotel_refund', 30);
            $table->char('hotel_type', 1);
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
        Schema::dropIfExists('hotel');
    }
};