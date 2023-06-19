<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_12_083901_creeate_hotels_table.php
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
    // 0612 BYJ new
    public function up()
    {
        Schema::create('hanoks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hanok_name', 100);
            $table->string('hanok_local', 30);
            $table->string('hanok_comment', 300);
            $table->string('hanok_addr', 200);
            $table->string('longitude', 30);
            $table->string('latitude', 30);
            $table->string('hanok_num', 20);
            $table->string('hanok_info', 1000);
            $table->string('hanok_refund', 300);
            $table->char('hanok_type', 1);
            $table->string('hanok_img1', 300);
            $table->string('hanok_img2', 300);
            $table->string('hanok_img3', 300);
            $table->string('hanok_img4', 300)->nullable();
            $table->string('hanok_img5', 300)->nullable();
            $table->string('license_num', 20); // 0615 add
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