<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller
 * 파일명     : ReviewController.php
 * 이력       : 0615 new BYJ
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Hanoks;
use App\Models\Reservations;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function index()
    {
        // 로그인 체크
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        // $result = Reviews::select('rev_id', 'rev_content', 'hanok_id', 'rate', 'created_at', 'updated_at')
        // ->selectRaw('DATE_ADD(deadline, INTERVAL 30 DAY) AS new_deadline')
        // ->orderBy('created_at', 'desc')
        // ->get();
        // return view('reviewlist')->with('data', $result);
    }
    public function reviewinsert() {
        
        return view('reviewinsert');
    } 
    public function checkDataAndRedirect()
    {
        $dataExists = /* 데이터 존재 여부를 확인하는 로직 */;
        
        if ($dataExists) {
            // 데이터가 있는 경우
            return redirect()->back()->with('message', '데이터가 이미 존재합니다.');
        } else {
            // 데이터가 없는 경우
            return redirect()->route('other-page');
        }
    }
    
    public function reviewpost(Request $req)
    {

        // $users = Users::find(Auth::User()->user_id);
        // $user_id = Auth::Hanok()->hanok_id;
        // 현재 로그인한 사용자를 가져옵니다.
    // $user = Auth::user()->user_id;

    // 예약정보
    // $reserve = Reservations::Reserve()->id;
    // $roomId = DB::table('reservations')->where('id')->value('room_id');
    // $hanokId = DB::table('rooms')->where('id', $roomId)->value('hanok_id');
    // $result = Reviews::select(['rev_id','rev_content', 'rate', 'created_at', 'updated_at'])
    //                     ->orderBy('created_at', 'desc')
    //                     ->get();
    // $reservation = Reservations::find($result); 

    // $reservationId = $reservation->room_id;
    // $roomId = DB::table('reservations')->where('id')->value('room_id');
    // $hanoks = Hanoks::pluck('hanok_name', 'id');

    // 객실 테이블을 통해 숙소 테이블의 ID 값.
    // $hanokId = DB::table('rooms')->where('id', $roomId)->value('hanok_id');


    // if ($hanokId === null) {
    //     $hanokId = 0;
    // }
    

    $req->validate([
        'rate' => 'required'
        ,'rev_contents' => 'required|max:1000'
    ]);

    $deadline = date('Y-m-d', strtotime('+30 days'));
    
    // if ($deadline === null) {
    //     $deadline = 'date';
    // }
    // 사용자와 관련된 모든 예약
    // $reservations = $user->reservations;

    // 첫 번째 예약 정보
    // $firstReservation = $reservations->first();

    // 첫 번째 예약된 방
    // $room = $firstReservation->room_id;

    // 방 ID.
    // $roomId = $room->id;
    $userId = Auth::User()->user_id;
    $hanokId = DB::table('reservations')
    ->join('rooms', 'rooms.id', '=', 'reservations.room_id')
    ->join('hanoks', 'hanoks.id', '=', 'rooms.hanok_id')
    ->where('reservations.user_id', $userId)
    ->value('hanoks.id');
    

    $Review = new Reviews([
        'user_id' => Auth::User()->user_id
        ,'hanok_id' => $hanokId
        ,'rate' => $req->input('rate')
        ,'rev_content' => $req->input('rev_content')
        ,'deadline' => $deadline
    ]);
        


    
        // $Review = new Reviews([
        //     'user_id' => Auth::User()->user_id
        //     ,'room_id' => Reservations::find(Auth::User()->room_id)
        //     ,'rate' => $req->input('rate')
        //     ,'rev_content' => $req->input('rev_content')
        // ]);

        // $userId = Auth::user()->id;
        // $roomId = Auth::user()->room_id;
        
        // $user = Users::find($userId);
        // $room = Reservations::find($roomId);
        
        // $Review = new Reviews([
        //     'user_id' => $user->user_id,
        //     'room_id' => $room->id,
        //     'rate' => $req->input('rate'),
        //     'rev_content' => $req->input('rev_content')
        // ]);
        

        // dd(Users::find(Auth::User()->user_id));
        // return var_dump($req);
        $Review->save();
        
        return redirect('/users/myreview');
    }

    // function getData() {
    //     $review = Reviews::all();
        
    //     return $review;
    // }
}