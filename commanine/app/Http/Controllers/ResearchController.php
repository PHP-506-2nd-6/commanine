<?php

    /**************************************
    * 프로젝트명 : commanine
    * 디렉토리   : app/Http/Controllers
    * 파일명     : ReseachController.php
    * 이력       : 0616 KMH new
    * *********************************** */ 

namespace App\Http\Controllers;

use App\Models\Hanoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ResearchController extends Controller
{
    // public function researchPage(){
    //     return view('research');
    // }

    // 0616 BYJ
    public function researchPage(Request $req) {
        // $search_text = $_GET['query'];
        // $hanoks = Hanoks::where('hanok_name', '%'.$search_text.'%')->get();

        // $search_text = $req->search;
        // $searches = Hanoks::search($search_text);

        // return view('research', compact(['searches', 'search_text']));

        if (request('search')) {
            $hanok = Hanoks::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $hanok = Hanoks::all();
        }

        return view('research')->with('hanok', $hanok);
        
        
        // $search = $req['search'] ?? "";
        // if ($search != "") {
        //     //where
        //     $hanok = Hanoks::where('hanok_name','=', $search)->get();
        // } else {
        //     $hanok = Hanoks::all();
        // }
        // $data = compact('hanoks','search');
        // return view('research')->with($data);
    }

    public function researchPageget(Request $req){
        // 이게 맞니...;;;;
        // return var_dump($req->hanokType);
        //todo : 집에 가서 할래.. 쿼리 작성
        $val_local = $req->input('locOrHan');
        $val_chkIn = $req->input('chkIn');
        $val_chkOut = $req->input('chkOut');
        $val_type = $req->hanokType;
        $val_count = $req->input('adults')+$req->input('kids');
        $val_price = $req->input('price');
        $result = DB::table('hanoks')
        // 지역, 호텔명 검색했을 때 
        ->join('rooms', 'hanoks.id', '=', 'rooms.hotel_id')
        ->join('wishlists', 'hanoks.id', '=', 'wishlists.hanok_id')
        ->join('reviews', 'hanoks.id', '=', 'reviews.hanok_id')
        ->select( 'hanoks.hanok_name','hanoks.hanok_img1', 'hanoks.hanok_local','rooms.room_price','reviews.rev_id')
        ->when($val_local, function ($query, $val_local) {
            $query->where('hanok_name', 'LIKE', "%{$val_local}%")
            ->orWhere('hanok_addr', 'LIKE', "%{$val_local}%");
        })
        // ->when($val_type , function ($query, $val_type){
        //     $query->where('hanok_type','=',$val_type);
        // })
        ->when($val_count, function($query, $val_count){
            $query->where('');
        })
        ->when($val_chkIn,function($query, $val_chkIn){
            $query->where('');
        })
        ->when($val_chkOut,function($query, $val_chkOut){
            $query->where('');
        })
        ->when($val_price,function($query, $val_price){
            $query->where('
            ');
        })
        ->orderBy('rooms.room_price','desc')
        ->get();

        return view('research')->with('search', $result);
        // ;
        // ->dd();
        // var_dump($result);
        // ->when(isset($req->locOrHan), function($query) {
        //     $query->where('hanok_name', 'LIKE', "%{$req->locOrHan}%")
        //     ->orWhere('hanoks.local', 'LIKE', "%{$req->locOrHan}%");
        // })



        // ->when(isset($req->locOrHan),[where('hanok_name', 'LIKE', "%{$req->locOrHan}%")
        //     ->orWhere('hanoks.local', 'LIKE', "%{$req->locOrHan}%")]);
        // ->dd();


        // ->dd();
        
        // User::select(['a', 'b'])
        //               ->when(isset($where['name']), function($query) {
        //                   $query->where('name', 'LIKE', "{$searchWord}%");
        //               })->when(isset($where['name']), function($query) {
        //                   $query->where('group', $searchWord);
        //               })->orderBy('users.created_at', 'desc')
        //                 ->paginate($perPage); // paging부분도 Model외부에서 처리하는게 좋다고 생각합니다.
    }


}