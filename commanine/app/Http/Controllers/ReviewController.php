<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller
 * 파일명     : ReviewController.php
 * 이력       : 0615 new BYJ
 *             0627 add KMJ
 *             0629 add KMJ
 * *********************************** */
namespace App\Http\Controllers;

use App\Models\Hanoks;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ReviewController extends Controller
{
    // 리뷰작성
    public function reviewinsert() {
        $hanok_id=$_GET['hanok_id'];
        return view('reviewinsert')->with('data',$hanok_id);
    } 
    
    public function reviewpost(Request $req)
    {
        $rating = $req->input('rating');

        $error = '별점과 리뷰를 작성해 주세요.';
        // 유효성 검사
        $validator = Validator::make(
            $req->only('rate','rev_content')
            ,[
                'rate' => 'required'
                ,'rev_content' => 'required|max:1000'
            ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$error);
        }

    $deadline = date('Y-m-d', strtotime('+30 days'));

    $Review = new Reviews([
        'user_id' => Auth::User()->user_id
        ,'hanok_id' => $req->hanok_id
        ,'rate' => $req->input('rate')
        ,'rev_content' => $req->input('rev_content')
        ,'deadline' => $deadline
    ]);

        $Review->save();
        return redirect('/users/review')->with('rating', $rating);
    }

    // 내 리뷰 페이지 0627 add KMJ
    public function review() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        $user_id = Auth::User()->user_id;
        $reviews = DB::table('hanoks as h')
                    ->join('reviews as r', 'h.id', '=', 'r.hanok_id')
                    ->select('r.*', 'h.hanok_name')
                    ->where('r.user_id', '=', $user_id)
                    ->where('r.deleted_at', '=', null)
                    ->orderBy('r.rev_id', 'desc')
                    ->paginate(5);
        
        return view('review')->with('review', $reviews);
    }

    // 리뷰 수정 0629 add KMJ
    public function reviewEdit($rev_id) {

        $sql = 
        " select r.*, h.hanok_name "
        ." from hanoks h "
        ." inner join reviews r "
        ."  on h.id = r.hanok_id "
        ." where r.rev_id = ".$rev_id
        ;

        $review = DB::select($sql);

        return view('reviewedit')->with('review', $review[0]);
    }
    
    public function reviewEditPost($rev_id,Request $req) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }

        $arr = ['rev_id' => $rev_id];
        $req->request->add($arr);
        
        $req->validate([
            'rev_id'        => 'required|integer'
            ,'rev_content'  => 'required|max:1000'
        ]);
        
        $review = Reviews::findOrFail($rev_id);
        $review->rev_content = $req->rev_content;
        $review->save();
        return redirect('/users/review');
    }

    // 리뷰 삭제 0627 add KMJ
    public function deleteReview($rev_id) {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }
        Reviews::destroy($rev_id);
        return redirect('/users/review');
    }
}