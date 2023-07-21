<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : Hanoks.php
 * 이력       : 0614 new
 * *********************************** */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 0614 KMJ new
class Hanoks extends Model
{
    use HasFactory;

    protected $table = 'hanoks';

    protected $primaryKey = 'id';
    protected $guarded = [];
}
