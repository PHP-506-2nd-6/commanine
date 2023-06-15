<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : Wishlist.php
 * 이력       : 0613 new
 * *********************************** */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlists extends Model
{
    protected $table = 'hanoks';

    protected $primaryKey = ['user_id','hotel_id'];
    //0613 KMH new
    use HasFactory;
    protected $guarded=[
        'user_id'
        ,'hotel_id'
    ];
}
