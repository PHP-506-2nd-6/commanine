<?php
/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Controller\Api
 * 파일명     : ApiWishlistsController.php
 * 이력       : 0717 new KMH
 * *********************************** */


namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        
        $data['hanok_id']   = $request->get('hanok_id');
        $data['user_id']   = $request->get('user_id');
        $wish = Wishlists::create($data);   // insert 
        if($wish){
            $arr['errorcode']="0";
            $arr['msg']="찜하기 성공";
        }
        return response()->json($arr,Response::HTTP_OK);
        

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
    public function destroy($id)
    {
        $user_id = Auth::User()->user_id;
        $deleteWish = Wishlists::where('hanok_id',$id)
                        ->where('user_id',$user_id)
                        ->first();
        $delAlarm = $deleteWish->delete();
        if($delAlarm){
            $arr['errorcode'] = "001";
            $arr['msg'] = "찜 삭제";
        }else{
            $arr['errorcode'] = "E001";
            $arr['msg'] = "찜 삭제 에러";
        }

        return response()->json($arr,Response::HTTP_OK);
    }
}
