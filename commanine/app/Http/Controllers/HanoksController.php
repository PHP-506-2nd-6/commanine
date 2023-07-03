<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Models
 * 파일명     : HanoksController.php
 * 이력       : 0614 new
 *              0619 add
 *              0621 add
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Hanoks;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// 0614 KMJ new
class HanoksController extends Controller
{
    public function hanoksDetail($id, Request $req) {
        $hanoks = Hanoks::find($id);

        $val_count = $req->reserve_adult + $req->reserve_child;
        $val_chkIn = $req->chk_in;
        $val_adult = $req->reserve_adult;
        $val_child = $req->reserve_child;

        // 입력한 사람 수(성인)가 없거나 입력한 사람 수가 1미만 16초과될 때 기본값으로 돌린다
        if($val_adult === null || $val_adult < 1 || $val_adult > 16) {
            $val_adult = 2;
        }
        // 입력한 사람 수(아동)가 없거나 입력한 사람 수가 0이하 16초과될 때 기본값으로 돌린다
        if($val_child === null || $val_child <= 0 || $val_child > 16) {
            $val_child = 0;
        }

        $val_count = $val_adult + $val_child;
        
        // 입력한 날짜값이 없거나 오늘 날짜보다 이전 날짜일 때 오늘 날짜 넣어준다
        $val_chkOut = $req->input('chk_out');
        $nowDate = Carbon::now();

        if($val_chkIn === null || $val_chkIn < $nowDate) {
            $val_chkIn = $nowDate->format("Y-m-d");
        }
        // 입력한 날짜값이 없거나 체크인 날짜보다 이전 날짜이거나 똑같을 때 오늘 날짜 넣어준다
        if($val_chkOut === null || $val_chkOut <= $val_chkIn) {
            $val_chkOut = $nowDate->addDay()->format("Y-m-d");
        }
        // return var_dump($val_chkOut);
        // 입력한 값 유지하기 위해서 배열로 담아서 view로 보내주기 위한 처리
        $inpData = [
            'val_chkIn' => $val_chkIn
            ,'val_chkOut' => $val_chkOut
            ,'val_adult' => $val_adult
            ,'val_child' => $val_child
        ];

        // 쿼리문 날리기 위해서 날짜에서 '-' 빼주는 처리
        $val_chkIn = str_replace('-','',$val_chkIn);
        $val_chkOut = str_replace('-','',$val_chkOut);

        // 해당 숙소의 예약 안 되어있는 객실 가격순대로 가져오기 0621 KMJ add
        $query =
        " SELECT r.* "
        ." FROM rooms r "
        ." WHERE r.hanok_id = ".$id
		."  AND r.room_max >= ".$val_count
		."  AND r.id NOT IN ( "
						."  SELECT res.room_id "
						."  FROM reservations res "
						."  WHERE res.chk_in < ".$val_chkOut
						."  AND res.chk_out > ".$val_chkIn
                        ." ) "
        ." ORDER BY r.room_price "
                        ;
                        
        $rooms = DB::select($query);
        
        // 해당 숙소의 찜 갯수 가져오기 0615 KMJ add
        $likes = DB::table('hanoks as h')
                        ->join('wishlists as w', 'h.id', '=', 'w.hanok_id')
                        ->select(DB::raw("count(w.user_id) as 'likes'"))
                        ->where('h.id', '=', $id) // 체이닝 메소드는 자동으로 prepared statement 적용(Raw는 불가능)
                        ->get();

        // 해당 숙소의 어메니티 가져오기 0622 KMJ add
        $amenities = DB::table('amenities as a')
                            ->join('amenity_categories as ac', 'a.amenity_category', '=', 'ac.id')
                            ->where('hanok_id', '=', $id)
                            ->get();

        // 해당 숙소의 리뷰 가져오기 0619 KMJ add
        $reviews = DB::table('hanoks as h')
                        ->join('reviews as r', 'h.id', '=', 'r.hanok_id')
                        ->select('r.*')
                        ->where('h.id', "=", $id)
                        ->where('r.deleted_at', '=', null)
                        ->orderBy('rev_id', 'desc')
                        ->paginate(5);

        // 해당 숙소의 평균 별점 가져오기 0626 KMJ add
        $rate = DB::table('reviews')
                        ->select(DB::raw("avg(rate) as 'rate', count(rev_id) as 'rev_cnt'"))
                        ->where('hanok_id', '=', $id)
                        ->where('deleted_at', '=', null)
                        ->get();


        // return view('detail')->with('hanok', $hanoks); // 0615 KMJ del
        // return view('detail', [])
        return view('detail')
                ->with('hanok', $hanoks)
                ->with('rooms', $rooms)
                ->with('likes', $likes[0])
                ->with('amenities', $amenities)
                ->with('reviews', $reviews)
                ->with('rate', $rate[0])
                ->with('inpData', $inpData); // 0615 KMJ add
    }


    // 0619 BYJ new
    public function hanoksMain() {

    // 로그인 후 헤더 유저 이름 출력 
    // if(auth()->guest()) {
    //     return redirect()->route('users.login');
    // }
    
    // $users = Users::find(Auth::User()->user_id);
    // $users = DB::table('users')
    // ->select('user_name')
    // ->where('user_id' , "=", $id)
    // ->get();


        
        // 최신순
        // $hanoks = DB::table('hanoks as han')
        // -> select('han.id','han.hanok_name', 'han.hanok_img1', 'han.hanok_local', DB::raw('MIN(ro.room_price) AS room_price'))
        // -> join('rooms as ro', 'han.id', '=', 'ro.hanok_id')
        // -> groupBy('han.id','han.hanok_name', 'han.hanok_img1', 'han.hanok_local')
        // -> orderBy('han.id', 'DESC')
        // -> limit('6')
        // -> get();
        
        $hanoks = DB::table('hanoks AS han')
    ->select('han.id','han.hanok_name', 'han.hanok_img1', 'han.hanok_local', DB::raw('MIN(ro.room_price) AS room_price'), DB::raw('AVG(re.rate) AS review'))
    ->join('rooms AS ro', 'han.id', '=', 'ro.hanok_id')
    ->leftJoin('reviews AS re', 're.hanok_id', '=', 'han.id')
    ->groupBy('han.id','han.hanok_name', 'han.hanok_img1', 'han.hanok_local')
    ->where('re.deleted_at', '=', null)
    ->orderBy('han.id', 'DESC')
    ->limit(6)
    ->get();


        
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

// 인기순
// $query = DB::table('hanoks AS han')
//     ->join(DB::raw('(SELECT r.hanok_id, MIN(r.room_price) AS room_price
//                     FROM rooms r
//                     WHERE r.room_price
//                     GROUP BY r.hanok_id) AS room'), 'han.id', '=', 'room.hanok_id')
//     ->leftJoin('wishlists AS wish', 'room.hanok_id', '=', 'wish.hanok_id')
//     ->join('reviews AS re', 're.hanok_id', '=', 'han.id')
//     ->select('han.id', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local', 'room.room_price', DB::raw('COUNT(wish.hanok_id) AS cnt'), DB::raw('AVG(re.rate) AS review'))
//     ->groupBy('han.id', 'han.hanok_name', 'han.hanok_img1', 'room.room_price','han.hanok_local')
//     ->orderBy('cnt', 'DESC')
//     ->limit(3)
//     ->get();
// --  2--
    $query = DB::table('hanoks AS han')
    ->join(DB::raw('(SELECT r.hanok_id, MIN(r.room_price) AS room_price
                    FROM rooms r
                    WHERE r.room_price
                    GROUP BY r.hanok_id) AS room'), 'han.id', '=', 'room.hanok_id')
    ->join('wishlists AS wish', 'room.hanok_id', '=', 'wish.hanok_id')
    ->select('han.id', 'han.hanok_name', 'han.hanok_img1', 'han.hanok_local', 'han.hanok_comment', 'room.room_price', DB::raw('COUNT(wish.hanok_id) AS cnt'))
    ->groupBy('han.id', 'han.hanok_name', 'han.hanok_img1', 'room.room_price','han.hanok_local', 'han.hanok_comment')
    ->orderBy('cnt', 'DESC')
    ->limit(3)
    ->get();

    
    return view('/main')->with('hanok', $hanoks)->with('wish', $query);

}

}