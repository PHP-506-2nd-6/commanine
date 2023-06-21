<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_20_020424_alter_users_table.php
 * 이력       : 0620 new
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
    // 0620 KMJ 사업자 회원 없어졌으므로 관련 컬럼 삭제
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['license_num', 'owner_name', 'company']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
