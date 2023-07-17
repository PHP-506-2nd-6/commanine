<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migrations
 * 파일명     : 2023_07_17_091314_create_admin_table.php
 * 이력       : 0717 KMH new
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
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_id',50);
            $table->string('admin_pw',256);
            $table->string('admin_name',30);
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
        Schema::dropIfExists('admin');
    }
};
