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
        // return var_dump($req->all());
        // 지역명/ 호텔명
        $val_local = $req->input('locOrHan');
        // 체크인
        $val_chkIn = $req->input('chkIn');
        // 체크인 서브쿼리
        // $chkInSub = DB::table('reservations')->select('room_id')->where('reservations.chk_in','<=',$val_chkIn);
        // return var_dump($chkInSub);
        // 체크아웃
        $val_chkOut = $req->input('chkOut');
        if($val_chkOut === null){
            $val_chkOut = date('Y-m-d', strtotime($val_chkIn . ' +1 day'));
        }
        // return var_dump($val_chkIn,$val_chkOut);
        // 체크아웃 서브쿼리
        // $chkOutSub = DB::table('reservations')->select('room_id')->where('reservations.chk_out','>=',$val_chkOut);
        // 숙소유형
        $val_type = $req->hanokType;
        // return var_dump($val_type);
        // if($val_type === '숙소유형'){
        //     $val_type = null;
        // }
        // return var_dump($val_type);
        // 인원
        $val_count = $req->input('adults')+$req->input('kids');
        // return var_dump($val_count);
        // 가격
        $val_price = $req->input('price');

        // 쿼리 작성
        $result = DB::table('hanoks')
        ->join('rooms', 'hanoks.id', '=', 'rooms.hanok_id')
        ->join('wishlists', 'hanoks.id', '=', 'wishlists.hanok_id')
        // ->join('reviews', 'hanoks.id', '=', 'reviews.hanok_id')
        ->select( 'hanoks.hanok_name','hanoks.hanok_img1','rooms.room_price')
        
        // 지역, 호텔명 검색했을 때 
        ->when($val_local, function ($query, $val_local) {
            $query->where('hanok_name', 'LIKE', "%{$val_local}%")
            ->orWhere('hanok_addr', 'LIKE', "%{$val_local}%");
        })
        // 숙소유형 검색
        ->when($val_type , function ($query, $val_type){
            $query->where('hanoks.hanok_type','=',$val_type);
        })
        // 인원
        ->when($val_count, function($query, $val_count){
            $query->where('rooms.room_max','>=',$val_count);
        })
        // 체크인
        // 체크인 날짜를 선택하면 체크인 날짜 이후의 날짜 중, 체크인이 가능한 숙소만 출력이 되어야 함. 
        // => 예약테이블에서 체크인 날짜 이후에 예약되어있는 숙소를 제외하고, 
        // 선택한 체크인 날짜 이전에 날짜는 출력이 되면 안됨. 
        // ->when($val_chkIn, function ($query, $val_chkIn) use ($chkInSub) {
        //     $query->whereNotIn('rooms.id', $chkInSub)
        //         ->where('reservations.chk_in', '>=', $val_chkIn);
        // })

        // ->when($val_chkIn, function ($query) use ($val_chkIn) {
        //     $query->whereNotExists(function ($query) use ($val_chkIn) {
        //         $query->select(DB::raw(1))
        //             ->from('reservations')
        //             ->where('reservations.chk_in', '>=', $val_chkIn);
        //     });
                    
        //     });
        // })
        // 체크인 날짜만 선택했을 경우 자동으로 1박으로 계산 
        ->when($val_chkIn, function ($query) use ($val_chkIn,$val_chkOut) {
            $query->whereNotExists(function ($subQuery) use ($val_chkIn,$val_chkOut) {
                $subQuery->select(DB::raw(1))
                    ->from('reservations')
                    ->whereColumn('rooms.id', 'reservations.room_id')
                    ->where('reservations.chk_in', '>=', $val_chkIn)
                    ->where('reservations.chk_out','<=',$val_chkOut);
            });
        })
//         select hanoks.hanok_name, hanoks.hanok_img1, rooms.room_price, count(wishlists.user_id)
//          from hanoks
//          inner join rooms
//          on hanoks.id = rooms.hanok_id
//          inner join wishlists 
//          on hanoks.id = wishlists.hanok_id 
//          where not EXISTS 
//  chkin날짜 이후 예약이 있는 경우 그것을 제외한 데이터 출력 
//          (select 1 from reservations where reservations.chk_in >= 2023-06-18)
// ;

        // 체크아웃
        // ->when($val_chkOut, function ($query) use ($val_chkOut) {
        //     $query->whereNotExists(function ($subQuery) use ($val_chkOut) {
        //         $subQuery->select(DB::raw(1))
        //             ->from('reservations')
        //             ->whereColumn('rooms.id', 'reservations.room_id')
        //             ->where('reservations.chk_in', '<=', $val_chkOut);
        //     });
        // })
        // 가격 
        ->when($val_price, function($query, $val_price){
            $query->where('rooms.room_price','<=',$val_price);
        })
        ->orderBy('rooms.room_price','desc')
        ->dd();

        return view('research')->with('searches', $result);
        // return var_dump($result);


        // SELECT문에 1을 사용하면 해당 테이블의 갯수만큼 1로된 행을 출력한다.
        // 테이블의 행의 수가 N개이면 1이 N개의 행만큼 반환된다.
        // 여기에서 1은 TRUE를 의미한다.
        // WHERE 조건문과 함께 쓰면 해당 조건을 만족하면 1을 반환하게 된다.

        // SQL Server에서 EXISTS 연산자는 서브쿼리에 데이터가 존재하는지 체크하고 존재할 경우 TRUE를 반환하며, 대표적으로 EXISTS 구문과 NOT EXISTS 구문이 있다. 
        // EXISTS 연산자는 IN 연산자와 비슷한 용도로 사용할 수 있으며, IN 연산자는 비교할 값을 직접 대입할 수 있지만 EXISTS 연산자는 서브쿼리만 사용할 수 있다.
        // NOT EXISTS는 EXISTS와 반대로 서브쿼리에 데이터가 존재하지 않을 경우 데이터가 조회된다.
        // NOT EXISTS도 서브쿼리에 데이터를 1건이라도 찾으면 검색을 멈추고 TRUE를 반환한다.
        //  NOT이 붙었기 때문에 (TRUE → FALSE, FALSE → TRUE) 반환 값이 반대로 바뀌어서 서브쿼리에 존재하지 않는 데이터만 조회된다.
    }

    // 헤더에서 검색을 하면 route('research.page')로 검색한 데이터를 보내야함

}