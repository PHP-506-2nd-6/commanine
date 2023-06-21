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
        $val_minPrice = $req->input('minPrice');
        $val_maxPrice = $req->input('maxPrice');
        
        // 쿼리 작성
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
        // 가격
        if($val_maxPrice){
            $query .= " WHERE r.room_price <= ".$val_maxPrice; 
        }
        if($val_minPrice){
            $query .= " AND r.room_price >= ".$val_minPrice;
        }
        // 수용 가능 인원
            if($val_count){
                $query .= " AND r.room_max >= ".$val_count;
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
    
            $result = DB::select($query);
            $notices = $this->arrayPaginator($result, $req);
    
            return view('research')->with('searches', $notices);

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
        $val_minPrice = $req->input('minPrice');
        $val_maxPrice = $req->input('maxPrice');
        
        // 쿼리 작성
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
        
    
        $query= "SELECT
                han.id
                ,han.hanok_name
                ,han.hanok_img1
                ,room.room_price
                ,COUNT(wish.hanok_id) AS cnt
                FROM hanoks han
                JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
                FROM rooms r ";
        if($val_maxPrice){
            $query .= " WHERE r.room_price <= ".$val_maxPrice; 
        }
        if($val_minPrice){
            $query .= " AND r.room_price >= ".$val_minPrice;
        }
        if($val_count){
            $query .= " AND r.room_max >= ".$val_count;
        }
        if($val_chkIn){
        $query .= " AND NOT EXISTS
                    (SELECT 1
                    FROM reservations res
                    WHERE res.room_id = r.id
                    AND res.chk_in >=  ".$val_chkIn.
                    " AND res.chk_out <= ".$val_chkOut." ) ";
        }
        $query .= " GROUP BY r.hanok_id) room
                    ON han.id = room.hanok_id
                    LEFT JOIN wishlists wish ON room.hanok_id = wish.hanok_id ";

        if($val_local){
                $query .= " WHERE han.hanok_name like "."'%$val_local%'"
                ." OR han.hanok_addr LIKE "."'%$val_local%'";
                }
            // 호텔 유형
        if($val_type){
                $query .= " AND han.hanok_type = "."'$val_type'  ";
        }
                $query .=" GROUP BY 
                han.id
                ,han.hanok_name
                ,han.hanok_img1
                ,room.room_price 

                order by room.room_price ";



                $val_local = $req->input('locOrHan');
                // 체크인
                $val_chkIn = $req->input('chkIn');
                // 체크아웃
                $val_chkOut = $req->input('chkOut');
                // 체크인 날짜만 선택했을 경우 자동으로 1박으로 계산 
                if($val_chkOut === null){
                    $val_chkOut = date('Y-m-d', strtotime($val_chkIn . ' +1 day'));
                }
                



        $result = DB::select($query);
        // return var_dump($val_count);
        $notices = $this->arrayPaginator($result, $req);
        return view('research')
                ->with('searches', $notices)
                ->with('local',$val_local)
                ->with('chkIn',$val_chkIn)
                ->with('chkOut',$val_chkOut)
                ->with('type',$val_type)
                ->with('minPrice',$val_minPrice)
                ->with('maxPrice',$val_maxPrice);

    }

    //0620 KMH add
    // 페이지네이션
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