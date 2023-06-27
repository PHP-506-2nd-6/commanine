<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : HanoksController.php
 * 이력       : 0614 new
 *              0619 add
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Hanoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// 0614 KMJ new
class HanoksController extends Controller
{
    public function hanoksDetail($id, Request $req) {
        $hanoks = Hanoks::find($id);
        // todo 예약이 이미 된 날짜엔 객실 정보가 뜨지 않거나, 예약하기 버튼이 예약마감으로 바뀌든 비활성화되든 해야함
        // $rooms = DB::table('hanoks as h')
        //                 ->join('rooms as r', 'h.id', '=', 'r.hanok_id')
        //                 ->select('r.*')
        //                 ->where('h.id', '=', $id)
        //                 ->get(); // 0620 KMJ del
        $val_count = $req->reserve_adult + $req->reserve_child;
        $val_chkIn = $req->chk_in;
        $val_adult = $req->reserve_adult;
        $val_child = $req->reserve_child;
        // return var_dump($val_chkIn);
        // $val_count = $req->input('reserve_adult') + $req->input('reserve_child');
        // $val_chkIn = $req->input('chk_in');
        // $val_adult = $req->input('reserve_adult');
        // $val_child = $req->input('reserve_child');
        $val_count = $val_adult + $val_child;
        if($val_adult === null) {
            $val_adult = 2;
        }
        if($val_child === null) {
            $val_child = 0;
        }
        // $val_chkIn = '2023-06-14';
        $val_chkOut = $req->input('chk_out');
        if($val_chkIn === null) {
            $val_chkIn = date("Y-m-d");
        }
        if($val_chkOut === null) {
            $val_chkOut = date("Y-m-d", strtotime($val_chkIn."+1 day"));
        }
        // if()
        $inpData = [
            'val_chkIn' => $val_chkIn
            ,'val_chkOut' => $val_chkOut
            ,'val_adult' => $val_adult
            ,'val_child' => $val_child
        ];
        // return var_dump($inpData);
        // return var_dump($rooms);
        // $val_chkOut = '2023-06-15';
        $query =
        " SELECT * "
        ." FROM rooms r "
        ." WHERE r.hanok_id = ".$id
		."  AND r.room_max >= ".$val_count
		."  AND r.id NOT IN ( "
						."  SELECT res.room_id "
						."  FROM reservations res "
						// ."  WHERE res.room_id = r.id "
						// ."  AND res.chk_in <= '2023-06-22' "
						// ."  AND res.chk_out >= '2023-06-23' "
						."  WHERE res.chk_in < ".$val_chkOut
						."  AND res.chk_out > ".$val_chkIn
                        ." ) "
                        ;
                        
        $rooms = DB::select($query);
        // return var_dump($rooms, $val_chkOut, $val_chkIn);
        // 0615 해당 숙소의 찜 갯수 가져오기 KMJ add
        $likes = DB::table('hanoks as h')
                        ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
                        ->select(DB::raw("count(w.user_id) as 'likes'"))
                        ->where('h.id', '=', $id)
                        ->get();
        // 0622 해당 숙소의 어메니티 가져오기 KMJ add
        $amenities = DB::table('amenities as a')
                            ->join('amenity_categories as ac', 'a.amenity_category', '=', 'ac.id')
                            ->where('hanok_id', '=', $id)
                            ->get();
        // 0619 해당 숙소의 리뷰 가져오기 KMJ add
        $reviews = DB::table('hanoks as h')
                        ->join('reviews as r', 'h.id', '=', 'r.hanok_id')
                        ->select('r.*')
                        ->where('h.id', "=", $id)
                        ->where('r.deleted_at', '=', null)
                        ->orderBy('rev_id', 'desc')
                        ->paginate(5);
                        // ->groupBy('r.rev_id')
                        // ->get();
        $rate = DB::table('reviews')
                        ->select(DB::raw("avg(rate) as 'rate', count(rev_id) as 'rev_cnt'"))
                        ->where('hanok_id', '=', $id)
                        ->where('deleted_at', '=', null)
                        ->get();
        // TODO 리턴값 확인용 
        // return var_dump($reviews);
        // return view('detail')->with('hanok', $hanoks); // 0615 KMJ del
        return view('detail')
        // return redirect()->route('hanoks.detail', [ 'id' => $id])
                ->with('hanok', $hanoks)
                ->with('rooms', $rooms)
                ->with('likes', $likes[0])
                ->with('amenities', $amenities)
                ->with('reviews', $reviews)
                ->with('rate', $rate[0])
                ->with('inpData', $inpData); // 0615 KMJ new
    }


    // 0619 BYJ new
    public function hanoksMain() {
        // 최신순
        // $hanoks = DB::table('hanoks')
        //             -> select('*')
        //             -> orderBy('id','desc')
        //             -> limit('6')
        //             -> get();

        $hanoks = DB::table('hanoks as han')
        -> select('han.id','han.hanok_name', 'han.hanok_img1', 'han.hanok_local', DB::raw('MIN(ro.room_price) AS room_price'))
        -> join('rooms as ro', 'han.id', '=', 'ro.hanok_id')
        //-> join('reviews AS re', 'han.id', '=', 're.hanok_id')
        -> groupBy('han.id','han.hanok_name', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local')
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
    // return var_dump($hanoks);

    // 인기순
    // $hanokswi = DB::table('wishlists as wi')
    //     -> select('wi.hanok_id','han.hanok_name', 'han.hanok_img1', 'han.hanok_local', DB::raw('COUNT(wi.hanok_id) AS coun'))
    //     -> join('hanoks as han', 'han.id', '=', 'wi.hanok_id')
    //     //-> join('reviews AS re', 'han.id', '=', 're.hanok_id')
    //     -> groupBy('wi.hanok_id','han.hanok_name', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local')
    //     // -> groupBy('han.hanok_img1')
    //     // -> groupBy('han.hanok_local')
    //     // -> groupBy('ro.room_price')
    //     -> orderBy('coun', 'DESC')
    //     -> limit('3')
    //     -> get();

//     $query="SELECT
//     han.hanok_name
//     ,han.hanok_img1
//     ,room.room_price
//     ,COUNT(wish.hanok_id) AS cnt
//     FROM hanoks han
//     JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
//             FROM rooms r
//             WHERE r.room_price
//             GROUP BY r.hanok_id) room
//     ON han.id = room.hanok_id
//     LEFT JOIN wishlists wish ON room.hanok_id = wish.hanok_id
// GROUP BY han.hanok_name
//     ,han.hanok_img1
//     ,room.room_price 
// ORDER BY cnt DESC LIMIT 3;";

$query = DB::table('hanoks AS han')
    ->join(DB::raw('(SELECT r.hanok_id, MIN(r.room_price) AS room_price
                    FROM rooms r
                    WHERE r.room_price
                    GROUP BY r.hanok_id) AS room'), 'han.id', '=', 'room.hanok_id')
    ->leftJoin('wishlists AS wish', 'room.hanok_id', '=', 'wish.hanok_id')
    ->select('han.id', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local', 'room.room_price', DB::raw('COUNT(wish.hanok_id) AS cnt'))
    ->groupBy('han.id', 'han.hanok_name', 'han.hanok_img1', 'room.room_price','han.hanok_local')
    ->orderBy('cnt', 'DESC')
    ->limit(3)
    ->get();
    
    return view('/main')->with('hanok', $hanoks)->with('wish', $query);
}


}