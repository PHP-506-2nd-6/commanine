<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migrations
 * 파일명     : 2023_06_12_084625_create_hoteltypes_table.php
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
        Schema::create('hoteltypes', function (Blueprint $table) {
            $table->char('id', 1);
            $table->string('category', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoteltypes');
    }
};
