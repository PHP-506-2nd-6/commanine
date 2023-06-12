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
        Schema::create('userchks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',30);
            $table->string('chk_num',8);
            $table->timestamps();
            $table->dateTime('time_deadline');
            $table->char('chk_flg',1)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userchks');
    }
};
