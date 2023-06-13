<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migrations
 * 파일명     : 2023_06_12_084008_creeate_wishlists_table.php
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
    // 0612 KMH new
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('hotel_id');
            $table->primary(['user_id', 'hotel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
};
