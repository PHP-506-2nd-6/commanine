<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_12_084240_create_reservations_table.php
 * 이력       : 0612 new
 * *********************************** */

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
            $table->string('hotel_name',100);
            $table->string('room_img1',300);
            $table->string('room_name',100);
            // 0614 new
            $table->string('room_price',10);
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
