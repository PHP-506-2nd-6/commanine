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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
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

        // if (request('search')) {
        //     $hanok = Hanoks::where('name', 'like', '%' . request('search') . '%')->get();
        // } else {
        //     $hanok = Hanoks::all();
        // }

        // return view('research')->with('hanok', $hanok);
        
        
        // $search = $req['search'] ?? "";
        // if ($search != "") {
        //     //where
        //     $hanok = Hanoks::where('hanok_name','=', $search)->get();
        // } else {
        //     $hanok = Hanoks::all();
        // }
        // $data = compact('hanoks','search');
        return view('research');

    }

    public function researchPageget(Request $req){
        // 지역명/ 호텔명
        $val_local = $req->input('locOrHan');
        // 체크인
        $val_chkIn = $req->input('chkIn');
        // 체크아웃
        $val_chkOut = $req->input('chkOut');
        // 체크인 날짜만 선택했을 경우 자동으로 1박으로 계산 
        if($val_chkOut === null){
            $val_chkOut = date('Y-m-d', strtotime($val_chkIn . ' +1 day'));
        }

        // 숙소유형
        $val_type = $req->hanokType;
        // 인원
        $val_count = $req->input('adults')+$req->input('kids');
        // return var_dump($val_count);
        // 가격
        $val_price = $req->input('price');

        // 쿼리 작성
        // $result = DB::table('hanoks')
        // ->join('rooms', 'hanoks.id', '=', 'rooms.hanok_id')
        // // ->join('wishlists', 'hanoks.id', '=', 'wishlists.hanok_id')
        // // ->join('reviews', 'hanoks.id', '=', 'reviews.hanok_id')
        // ->select( 'hanoks.hanok_name','hanoks.hanok_img1',DB::raw('min(rooms.room_price),(SELECT COUNT(wishlists.hanok_id) as cnt FROM wishlists INNER JOIN hanoks ON wishlists.hanok_id = hanoks.id) AS wish'))
        
        // // 지역, 호텔명 검색했을 때 
        // ->when($val_local, function ($query, $val_local) {
        //     $query->where('hanoks.hanok_name', 'LIKE', "'%".$val_local."%'")
        //     ->where('hanoks.hanok_addr', 'LIKE', "'%".$val_local."%'");
        // })
        // // 숙소유형 검색
        // ->when($val_type , function ($query, $val_type){
        //     $query->where('hanoks.hanok_type','=',$val_type);
        // })
        // // ->when($val_type , function ($query, $val_type){
        // //     $query->where(DB::raw('(hanoks.hanok_type ='{{$val_type}}')'));
        // // })
        // // 인원
        // ->when($val_count, function($query, $val_count){
        //     $query->where('rooms.room_max','>=',$val_count);
        // })
        // // 체크인
        // // 체크인 날짜를 선택하면 체크인 날짜 이후의 날짜 중, 체크인이 가능한 숙소만 출력이 되어야 함. 
        // // => 예약테이블에서 체크인 날짜 이후에 예약되어있는 숙소를 제외하고, 
        // // 선택한 체크인 날짜 이전에 날짜는 출력이 되면 안됨. 
        // // ->when($val_chkIn, function ($query, $val_chkIn) use ($chkInSub) {
        // //     $query->whereNotIn('rooms.id', $chkInSub)
        // //         ->where('reservations.chk_in', '>=', $val_chkIn);
        // // })

        // // ->when($val_chkIn, function ($query) use ($val_chkIn) {
        // //     $query->whereNotExists(function ($query) use ($val_chkIn) {
        // //         $query->select(DB::raw(1))
        // //             ->from('reservations')
        // //             ->where('reservations.chk_in', '>=', $val_chkIn);
        // //     });
                    
        // //     });
        // // })
        // // ->when($val_chkIn, function ($query) use ($val_chkIn,$val_chkOut) {
        // //     $query->whereNotExists(function ($subQuery) use ($val_chkIn,$val_chkOut) {
        // //         $subQuery->select(DB::raw(1))
        // //             ->from('reservations')
        // //             ->whereColumn('rooms.id', 'reservations.room_id')
        // //             ->where('reservations.chk_in', '>=', $val_chkIn)
        // //             ->where('reservations.chk_out','<=',$val_chkOut);
        // //     });
        // // })
        // // ->when($val_chkIn, function ($query) use ($val_chkIn,$val_chkOut) {
        // //     $query->whereNotIn('rooms.id',function ($subQuery) use ($val_chkIn,$val_chkOut) {
        // //         $subQuery->select('room_id')
        // //             ->from('reservations')
        // //             ->where('reservations.chk_in', '>=', $val_chkIn)
        // //             ->where('reservations.chk_out','<=',$val_chkOut);
        // //     });
        // // })
        // // ->when($val_chkIn, function ($query) use ($val_chkIn,$val_chkOut) {
        // //     $query->where(DB::raw('NOT rooms.id in
        // //     (SELECT room_id from reservations 
        // //     where reservations.chk_in >= ')
        // //     AND reservations.chk_out <= ? '),[$val_chkIn,$val_chkOut]);
        // // })
        // ->when($val_chkIn, function ($query) use ($val_chkIn,$val_chkOut) {
        //     $query->whereRaw('NOT rooms.id in
        //     (SELECT room_id from reservations 
        //     where reservations.chk_in >= ?
        //     AND reservations.chk_out <= ? )',[$val_chkIn,$val_chkOut]);
        // })




        // // 체크아웃
        // // ->when($val_chkOut, function ($query) use ($val_chkOut) {
        // //     $query->whereNotExists(function ($subQuery) use ($val_chkOut) {
        // //         $subQuery->select(DB::raw(1))
        // //             ->from('reservations')
        // //             ->whereColumn('rooms.id', 'reservations.room_id')
        // //             ->where('reservations.chk_in', '<=', $val_chkOut);
        // //     });
        // // })
        // // 가격 
        // ->when($val_price, function($query, $val_price){
        //     $query->where('rooms.room_price','<=',$val_price);
        // })
        // // 'hanoks.hanok_name','hanoks.hanok_img1','rooms.room_price'
        // ->groupBy('hanoks.hanok_name','hanoks.hanok_img1')
        // // ->groupBy('hanoks.hanok_img1')
        // // ->groupBy('rooms.room_price')
        // // ->groupBy('cnt')
        // ->orderBy('rooms.room_price')
        // ->get();

        // ->paginate(5);
        
    //*********************** 쿼리
    //     $result = DB::select("SELECT
    //     han.hanok_name
    //     ,han.hanok_img1
    //     ,room.room_price
    //     FROM hanoks han
            // rooms테이블에 hanok_id와 최소가격 을 가져옴
    //     JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
    //             FROM rooms r
                // 수용가능 인원
    //             WHERE r.room_min >= 2
    //             AND r.room_max <= 2
                // 해당하는 체크인, 체크아웃 날짜가 예약 테이블에 존재하지 않는 데이터만 가져옴 
    //             AND NOT EXISTS
    //                 (SELECT 1
    //                 FROM reservations res
    //                 WHERE res.room_id = r.id
    //                 AND res.chk_in >= 20230614
    //                 AND res.chk_out <= 20230615)
    //             GROUP BY r.hanok_id) room
    //     ON han.id = room.hanok_id
    //     LEFT JOIN wishlists wish ON room.hanok_id = wish.hanok_id
    // WHERE han.hanok_name LIKE '%경주%'
    // -- AND han.hanok_type = '0'
    // ");
    //****************************************************************** */
    $query = " SELECT
        han.hanok_name
        ,han.hanok_img1
        ,room.room_price
        FROM hanoks han
        JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
                FROM rooms r ";
    // 수용 가능 인원
    if($val_price){
        $query .= " WHERE r.room_price <= ".$val_price; 
    }
        if($val_count){
            $query .= " AND r.room_min <= ".$val_count
                    ." AND r.room_max >= ".$val_count;
        }

    // 체크인
        if($val_chkIn){
            $query .= " AND NOT EXISTS
                        (SELECT 1
                        FROM reservations res
                        WHERE res.room_id = r.id
                        AND res.chk_in >=  ".$val_chkIn.
                        " AND res.chk_out <= ".$val_chkOut." ) ";
        }


        $query .=" GROUP BY r.hanok_id) room
            ON han.id = room.hanok_id
            LEFT JOIN wishlists wish 
            ON room.hanok_id = wish.hanok_id ";
    // 지역명/ 호텔명
        if($val_local){
            $query .= " WHERE han.hanok_name like "."'%$val_local%'";
        }
    // 호텔 유형
        if($val_type){
            $query .= " AND han.hanok_type = "."'$val_type'  ";
        }



        $notices = DB::select($query);
        $result = $this->arrayPaginator($notices, $req);
    
        return view('research')->with('searches', $result);
        
    }
    
    public function arrayPaginator($array, $request) {
        $page = $request->input('page',1);
        $perPage = 4;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice(
                $array,
                $offset,
                $perPage,
                true
            ),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
}

}