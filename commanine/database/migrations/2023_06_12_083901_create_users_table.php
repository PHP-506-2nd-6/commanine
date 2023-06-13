<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_12_083901_creeate_users_table.php
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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_email',50)->unique();
            $table->string('user_name',30);
            $table->string('user_pw',256);
            // 생각해보니까 birth는 date만 필요하지 않나???
            $table->char('pw_flg',1)->default('0');
            $table->date('user_birth');
            $table->char('user_num',11);
            $table->integer('user_que');
            $table->string('user_an',30);
            $table->timestamps();
            $table->softDeletes();
            // token도 테이블에 있어야할려나..?
            // $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
