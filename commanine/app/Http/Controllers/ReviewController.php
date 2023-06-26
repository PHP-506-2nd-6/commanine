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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // public function index()
    // {
    //     // 로그인 체크
    //     if(auth()->guest()) {
    //         return redirect()->route('users.login');
    //     }
    //     // $result = Reviews::select('rev_id', 'rev_content', 'hanok_id', 'rate', 'created_at', 'updated_at')
    //     // ->selectRaw('DATE_ADD(deadline, INTERVAL 30 DAY) AS new_deadline')
    //     // ->orderBy('created_at', 'desc')
    //     // ->get();
    //     // return view('reviewlist')->with('data', $result);
    // }
    public function checkDataAndRedirect()
    {
        $dataExists = Reviews::select('rev_id')
        ->from
        ->get();
        
        if ($dataExists) {
            // 데이터가 있는 경우
            return redirect()->back()->with('message', '데이터가 이미 존재합니다.');
        } else {
            // 데이터가 없는 경우
            return redirect()->route('/users/reviewinsert');
        }
        
        return view('reviewlist')->with('data', $dataExists);
    }
    public function reviewinsert() {
        
        return view('reviewinsert');
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

    // 내 리뷰 페이지
    public function myReview() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $user_id = Auth::User()->user_id;
        $reviews = DB::table('hanoks as h')
                        ->join('reviews as r', 'r.hanok_id', '=', 'h.id')
                        ->select('r.*', 'h.hanok_name')
                        ->where('r.user_id', '=', $user_id)
                        ->where('r.deleted_at', '=', null)
                        ->orderBy('r.rev_id', 'desc')
                        ->paginate(5);
                        // ->get();
        return view('myreview')->with('review', $reviews);
    }

    // 리뷰 삭제
    public function deleteReview($rev_id) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }

        // DB::table('reviews')
        //     ->where('rev_id', '=', $rev_id)
        //     ->delete();
        // DB::table('reviews')
        //     ->where('rev_id', '=', $rev_id)
        //     ->delete();
        // Reviews::destroy($id);
        $date = Carbon::now();
        DB::table('reviews')
            ->where('rev_id', $rev_id)
            ->update(['deleted_at' => $date]);
        
        return redirect('/users/myreview');
    }
}