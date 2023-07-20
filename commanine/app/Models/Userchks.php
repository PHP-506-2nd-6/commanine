<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : Userchks.php
 * 이력       : 0613 new
 * *********************************** */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

// 0613 KMH new
class Userchks extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $table = 'userchks';
    
    protected $primaryKey = 'id';

    protected $guarded=[

    ];


}
