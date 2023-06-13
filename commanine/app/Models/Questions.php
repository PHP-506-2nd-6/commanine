<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : Questions.php
 * 이력       : 0613 new
 * *********************************** */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 0613 KMH new
class Questions extends Model
{
    use HasFactory;
    protected $guarded=[
        'q_id'
        ,'q_content'
    ];
}
