<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migrations
 * 파일명     : 2023_06_12_083457_create_rooms_table.php
 * 이력       : 0612 new
 *             0613 add
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_name', 100);
            $table->string('room_content', 100);
            $table->string('room_price', 10);
            $table->integer('room_min');
            $table->integer('room_max');
            // $table->dateTime('chk_in'); // 0613 KMJ del
            // $table->dateTime('chk_out');
            $table->string('chk_in', 5); // 0613 KMJ add
            $table->string('chk_out', 5);
            $table->string('room_detail', 100);
            $table->string('room_facility', 100);
            $table->integer('hanok_id');
            $table->string('room_img1', 300); // 0613 KMJ add
            $table->string('room_img2', 300);
            $table->string('room_img3', 300);
            $table->string('room_img4', 300)->nullable();
            $table->string('room_img5', 300)->nullable();
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
