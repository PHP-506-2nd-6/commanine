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

class ReviewController extends Controller
{
    public function reviewinsert() {
        return view('reviewinsert');
    } 
    
    public function reviewpost(Request $req)
    {

        // $req->validate([
        //     'rate' => 'required'
        //     ,'rev_contents' => 'required|max:1000'
        // ]);


        $Reviews = new Reviews([
            'rate' => $req->input('rate')
            ,'rev_content' => $req->input('rev_content')
        ]);
        $Reviews->save();
        return redirect('/reviewinfo');
    }
}