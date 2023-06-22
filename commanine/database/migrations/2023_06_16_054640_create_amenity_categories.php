<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_16_054640_create_amenity_categories.php
 * 이력       : 0616 new
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
    // 0616 KMJ new
    public function up()
    {
        Schema::create('amenity_categories', function (Blueprint $table) {
            $table->char('id', 2)->primary();
            $table->string('amenity_name', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenity_categories');
    }
};
