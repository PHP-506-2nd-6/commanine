<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller\Api
 * 파일명     : ApiWishlistsController.php
 * 이력       : 0717 new KMH
 * *********************************** */


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiWishlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr['errorcode'] = '0';
        $arr['msg'] = 'Insert success';

        // 로그인이 안되어 있을 경우
        // Log::debug('ddd',[session('user_id')]);
        if(!$request->user_id) {
            $arr['errorcode'] = 'E01';
            $arr['msg'] = 'Not login';
            // Log::debug('비로그인',[$request->user_id]);
            return $arr;
        }else{
        // 로그인이 되어 있을 경우
        // $user = Auth::User()->user_id;
        // Log::debug('request',[$request->hanok_id,$request->user_id,$request]);
        $query = " INSERT INTO wishlists (user_id, hanok_id) values ( ? , ? ) ";
        $prepare = [$request->user_id, $request->hanok_id];
        $wish = DB::insert($query,$prepare);
        // $wish = DB::table('wishlists')->insert(['user_id'=>$request->user_id,'hanok_id'=>$request->hanok_id]);
        // Log::debug('통신',[var_dump($wish)]);
        // $wish = new Wishlists();
        // $wish->user_id = $request->user_id;
        // $wish->hanok_id = $request->hanok_id;
        // $wish->save();
        // Log::debug('통신',[$wish]);
        // $arr['data'] = $wish->only('hanok_id','user_id');
        return $arr;
        }

        // if(auth()->guest()) {
        //     return redirect()->route('users.login');
        // }
        // DB::transaction();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        // Log::debug('request',[$request]);
        // $user_id = Auth::User()->user_id;
        $arr['errorcode'] = '0';
        $arr['msg'] = 'Delete success';
        if(!$request->user_id) {
            $arr['errorcode'] = 'E01';
            $arr['msg'] = 'Not login';
            // Log::debug('비로그인',[$request->user_id]);
            return $arr;
        }else{
            $query = " DELETE FROM wishlists where user_id = ? AND hanok_id = ? ";
            $prepare = [$request->user_id , $request->hanok_id];
            $wish = DB::delete($query,$prepare);
        // $deleted = DB::table('wishlists')->where('user_id', '=', $request->user_id)->where('hanok_id','=',$request->hanok_id)->delete();
        // $wish = DB::table('wishlists')->insert(['user_id'=>$request->user_id,'hanok_id'=>$request->hanok_id]);
        // Log::debug('통신',[$wish]);
        // $wish = new Wishlists();
        // $wish->user_id = $request->user_id;
        // $wish->hanok_id = $request->hanok_id;
        // $wish->save();
        // Log::debug('통신',[$wish]);
        // $arr['data'] = $wish->only('hanok_id','user_id');
        }
    return $arr;
    }
}

