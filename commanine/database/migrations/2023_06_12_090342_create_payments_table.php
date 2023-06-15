<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : migration
 * 파일명     : 2023_06_12_084240_create_payments_table.php
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
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_id');
            $table->string('pay_price',30);
            $table->timestamps();
            $table->string('pay_type',30);
            $table->char('pay_flg',1)->default('0');
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
        Schema::dropIfExists('payments');
    }
};
