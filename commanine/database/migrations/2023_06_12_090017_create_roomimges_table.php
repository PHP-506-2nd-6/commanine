<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migrations
 * 파일명     : 2023_06_12_090017_create_roomimges_table.php
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
    // 0612 KMJ new
    public function up()
    {
        Schema::create('roomimges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_img', 100);
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
        Schema::dropIfExists('roomimges');
    }
};
