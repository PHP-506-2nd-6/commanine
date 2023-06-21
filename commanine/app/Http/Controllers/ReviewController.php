<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller
 * 파일명     : ReviewController.php
 * 이력       : 0615 new BYJ
 * *********************************** */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        // 로그인 체크
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }

        $result = Reviews::select(['rev_id','rev_content', 'rate', 'created_at', 'updated_at'])
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('reviewlist')->with('data', $result);
    }
    public function reviewinsert() {
        
        return view('reviewinsert');
    } 
    
    public function reviewpost(Request $req)
    {

        // $req->validate([
        //     'rate' => 'required'
        //     ,'rev_contents' => 'required|max:1000'
        // ])
        // $users = Users::find(Auth::User()->user_id);
        $Review = new Reviews([
            'user_id' => Users::find(Auth::User()->user_id)
            ,'rate' => $req->input('rate')
            ,'rev_content' => $req->input('rev_content')
        ]);
        // dd(Users::find(Auth::User()->user_id));
        // return var_dump($req);
        $Review->save();
        
        return redirect('/reviewinfo');
    }
}