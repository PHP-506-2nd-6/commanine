<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : HanoksController.php
 * 이력       : 0614 new
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Hanoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// 0614 KMJ new
class HanoksController extends Controller
{
    public function hanoksDetail($id) {
        $hanoks = Hanoks::find($id);
        // $hanoks = DB::table('hanoks as h')
        //                 ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
        //                 ->select('h.*',DB::raw("count(w.user_id) as likes"))
        //                 ->where('h.id', '=', $id)
        //                 ->groupBy('h.id','h.hanok_name')
        //                 ->get();
        // 0615 해당 숙소의 객실 정보 불러오기 KMJ new
        $rooms = DB::table('hanoks as h')
                        ->join('rooms as r', 'h.id', '=', 'r.hanok_id')
                        ->select('r.*')
                        ->where('h.id', '=', $id)
                        ->get();
        // 0615 해당 숙소의 찜 갯수 불러오기 KMJ new
        $likes = DB::table('hanoks as h')
                        ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
                        ->select(DB::raw("count(w.user_id) as 'likes'"))
                        ->where('h.id', '=', $id)
                        ->get();
        // TODO 리턴값 확인용  // return var_dump($hanoks);
        // return view('detail')->with('hanok', $hanoks); // 0615 KMJ del
        return view('detail')->with('hanok', $hanoks)->with('rooms', $rooms)->with('likes', $likes[0]); // 0615 KMJ new
    }
    // 0619 BYJ new
    public function hanoksMain() {
        // $hanoks = DB::table('hanoks')
        //             -> select('*')
        //             -> orderBy('id','desc')
        //             -> limit('6')
        //             -> get();

        $hanoks = DB::table('hanoks as han')
        -> select('han.hanok_name', 'han.hanok_img1', 'han.hanok_local', DB::raw('MIN(ro.room_price) AS room_price'))
        -> join('rooms as ro', 'han.id', '=', 'ro.hanok_id')
        //-> join('reviews AS re', 'han.id', '=', 're.hanok_id')
        -> groupBy('han.hanok_name', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local')
        // -> groupBy('han.hanok_img1')
        // -> groupBy('han.hanok_local')
        // -> groupBy('ro.room_price')
        -> orderBy('han.id', 'DESC')
        -> limit('6')
        -> get();


        
    // $hanoks = DB::table('hanoks AS han')
    // ->select('han.hanok_name', 'han.hanok_img1', 'han.hanok_local', 'ro.room_price')
    // ->join('rooms AS ro', 'han.id', '=', 'ro.hanok_id')
    // ->groupBy('han.id')
    // ->orderBy('han.id', 'desc')
    // ->limit(6);

    // $results = $hanoks->get();

    // foreach ($results as $result) {
    //     echo $result->hanok_name;
    //     echo $result->hanok_img1;
    //     echo $result->hanok_local;
    //     echo $result->room_price;  
    // }
    return view('/main')->with('hanok', $hanoks);
}
}