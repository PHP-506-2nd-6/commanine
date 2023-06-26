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
       // 지역명/ 호텔명
       $val_local = $req->input('locOrHan');
       // 체크인
       $val_chkIn = $req->input('chkIn');

       // 체크아웃
       $val_chkOut = $req->input('chkOut');
       // 체크인 날짜만 선택했을 경우 자동으로 1박으로 계산
       if($val_chkOut === null ){
           $val_chkOut = date('Y-m-d', strtotime($val_chkIn . ' +1 day'));
       }else{
           $val_chkOut = $req->input('chkOut');
       }

       // 인원
       $val_count = $req->input('adults')+$req->input('kids');

       
       $query= "SELECT
       han.id
       ,han.hanok_name
       ,han.hanok_img1
       ,room.room_price
       ,COUNT(review.hanok_id ) AS cnt
       ,AVG(review.rate) AS rate
       FROM hanoks han
          JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
                  FROM rooms r ";
       // 인원
    //    if($val_count){
    //        $query .= " where r.room_max >= ".$val_count;
    //    }
       // 체크인 / 체크아웃
       if($val_chkIn){
       $query .= " where r.id NOT IN      
                   (SELECT res.room_id
                   FROM reservations res
                   WHERE 
                       res.chk_out >  ".$val_chkIn.
                   " or res.chk_in < ".$val_chkOut." ) ";
       }
       $query .= " GROUP BY r.hanok_id) room
                   ON han.id = room.hanok_id
                   left JOIN reviews review ON han.id = review.hanok_id ";

       if($val_local){
               $query .= " WHERE ( han.hanok_name like "."'%$val_local%'"
               ." OR han.hanok_addr LIKE "."'%$val_local%'"." ) ";
               }

       $result = DB::select($query);

       $notices = $this->arrayPaginator($result, $req);
       return view('research')
               ->with('searches', $notices)
               ->with('local',$val_local)
               ->with('chkIn',$val_chkIn)
               ->with('chkOut',$val_chkOut);
    }


    
    public function researchPageget(Request $req){
        // 지역명/ 호텔명
        $val_local = $req->input('locOrHan');
        // 체크인
        $val_chkIn = $req->input('chkIn');
        // if($val_chkIn === null ){
        //     $val_chkIn = date('Y-m-d');
        // }else{
        //     $val_chkIn = $req->input('chkIn');
        // }
        // 체크아웃
        $val_chkOut = $req->input('chkOut');
        // 체크인 날짜만 선택했을 경우 자동으로 1박으로 계산 
        if($val_chkOut === null ){
            $val_chkOut = date('Y-m-d', strtotime($val_chkIn . ' +1 day'));
        }else{
            $val_chkOut = $req->input('chkOut');
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
//         SELECT
//    han.id
//    ,han.hanok_name
//    ,han.hanok_img1
//    ,room.room_price
//    ,COUNT( review.user_id ) AS cnt
//    ,AVG( review.rate ) AS rate
//    FROM hanoks han
//       JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
//       		FROM rooms r 
// 				WHERE r.room_price <= 200000 
//             AND r.room_price >= 20000
// 				AND r.room_max >= 2
//         		AND r.id NOT IN      
//                     (SELECT res.room_id
//                     FROM reservations res
//                     WHERE 
//                   	res.chk_out > 20230621
//                   	or res.chk_in < 20230623 )
// 				GROUP BY r.hanok_id) room
//       ON han.id = room.hanok_id
//       left JOIN reviews review ON han.id = review.hanok_id
// 	WHERE ( han.hanok_name LIKE '%경주%'
// 		OR han.hanok_addr LIKE '%경주%')
// 		AND han.hanok_type = "1"
// 		GROUP BY 
//       	han.id
//          ,han.hanok_name
//          ,han.hanok_img1
//          ,room.room_price 
// 		order by room.room_price;
        //****************************************************************** */

        $query= "SELECT
        han.id
        ,han.hanok_name
        ,han.hanok_img1
        ,room.room_price
        ,COUNT(review.hanok_id ) AS cnt
        ,AVG(review.rate) AS rate
        FROM hanoks han
           JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
                   FROM rooms r ";
        if($val_maxPrice){
            $query .= " WHERE r.room_price <= ".$val_maxPrice; 
        }
        // 최소가격
        if($val_minPrice){
            $query .= " AND r.room_price >= ".$val_minPrice;
        }
        // 인원
        if($val_count){
            $query .= " AND r.room_max >= ".$val_count;
        }
        // 체크인 / 체크아웃
        if($val_chkIn){
        $query .= " AND r.id NOT IN      
                    (SELECT res.room_id
                    FROM reservations res
                    WHERE 
                        res.chk_out >  ".$val_chkIn.
                    " or res.chk_in < ".$val_chkOut." ) ";
        }
        $query .= " GROUP BY r.hanok_id) room
                    ON han.id = room.hanok_id
                    left JOIN reviews review ON han.id = review.hanok_id ";

        if($val_local){
                $query .= " WHERE ( han.hanok_name like "."'%$val_local%'"
                ." OR han.hanok_addr LIKE "."'%$val_local%'"." ) ";
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
                
                order by room.room_price ;";




        $result = DB::select($query);
        // return var_dump($val_count);
        // return print_r($query);
        // return var_dump($result);
        
        // for($i=0;$i<count($result);$i++){
        //     $rate[] = substr( $result[$i]->rate, 0, 4 );
        // }
        // return var_dump($rate);
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
        $perPage = 8;
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