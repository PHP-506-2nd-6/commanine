<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_12_083901_creeate_amenities_table.php
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
        Schema::create('amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amenitiies_name', 50);
            $table->integer('hotel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // 0612 BYJ new
    public function down()
    {
        Schema::dropIfExists('amenities');
    }
};