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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ResearchController extends Controller
{
    
    // 0616 BYJ
    public function researchPage(Request $req) {

        // 유효성 검사 

        // $req->validate([
        //     'locOrHan' => 'required'
        //     ,'chkIn' => 'required'
        //     ,'chkOut' => 'required'
        // ]);
        $errorMsg ="모든항목은 필수항목입니다.";
        $validator = Validator::make($req->all(), [
            'locOrHan' => 'required'
            ,'chkIn' => 'required'
            ,'chkOut' => 'required'
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            return redirect()->back()->with('errormsg', $errorMsg)->withInput();
        }

       // 지역명/ 호텔명
        $val_local = $req->input('locOrHan');
       // 체크인
        $val_chkIn = $req->input('chkIn');

       // 체크아웃
        $val_chkOut = $req->input('chkOut');
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
                FROM rooms r 
                where r.room_max >= ?
                AND r.id NOT IN      
                    (SELECT res.room_id
                    FROM reservations res
                    WHERE 
                    res.chk_out > ?
                    AND res.chk_in < ? ) 
                    GROUP BY r.hanok_id) room
                    ON han.id = room.hanok_id
                    left JOIN reviews review ON han.id = review.hanok_id 
                    WHERE ( han.hanok_name like ?
                OR han.hanok_addr LIKE ? ) 
                GROUP BY 
                han.id
                ,han.hanok_name
                ,han.hanok_img1
                ,room.room_price
                
                order by room.room_price ; ";
    $prepare = [$val_count, $val_chkIn, $val_chkOut, "%".$val_local."%", "%".$val_local."%"];
       $result = DB::select($query, $prepare);
       $arr = ['local' => $val_local
                ,'chkIn' => $val_chkIn
                ,'chkOut' => $val_chkOut
                ,'adults' => $req->adults
                ,'kids' => $req->kids
        ];

       $notices = $this->arrayPaginator($result, $req);
       return view('research')
               ->with('searches', $notices)
               ->with('arr',$arr);

    }


    public function researchPageget(Request $req){
        // $validator = Validator::make($req->all(), [
        //     'locOrHan'   => []
        //     ,'chkIn'     => ['regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/u']
        //     ,'chkOut'    => ['regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/u']
        //     ,'hanokType' => ['regex:/^[0-3]{1}$/u']
        //     ,'adults'    => ['regex:/^[0-9]{2}$/u']
        //     ,'kids'      => ['regex:/^[0-9]{2}$/u']
        //     ,'minPrice'  => ['regex:/^[0-9]{8}$/u']
        //     ,'maxPrice'  => ['regex:/^[0-9]{8}$/u']
        // ]);
        // if ($validator->fails()) {
        //     $errorMessage = $validator->errors()->first();
        //     return redirect()->back();
        // }
        // 지역명/ 호텔명
        $val_local = $req->input('locOrHan');
        // 체크인
        $val_chkIn = $req->input('chkIn');
        // 체크아웃
        $val_chkOut = $req->input('chkOut');
        
        $inputChkIn = $req->input('chkIn');
        $inputChkOut = $req->input('chkOut');
        
        $val_chkIn = str_replace('-','',$val_chkIn);
        $val_chkOut = str_replace('-','',$val_chkOut);

        // 숙소유형
        $val_type = $req->input('hanokType');
        // 성인
        $val_adults = $req->input('adults');
        // 어린이
        $val_kids = $req->input('kids');
        if( $val_type === "0" || $val_type === "1" || $val_type === "2" || $val_type === "3"){
            $val_type = $req->input('hanokType');
        }else{
            $val_type = null;
        }
        // 인원
        $val_count = $req->input('adults')+$req->input('kids');
        // 최소가격
        $val_minPrice = $req->input('minPrice');
        // 최대가격
        $val_maxPrice = $req->input('maxPrice');
        Log::debug('val 값',[$val_local, $val_chkIn, $val_chkOut, $val_type , $val_adults, $val_kids , $val_count]);
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
//                   	AND res.chk_in < 20230623 )
// 				GROUP BY r.hanok_id) room
//       ON han.id = room.hanok_id
//       left JOIN reviews review ON han.id = review.hanok_id
// 	    WHERE ( han.hanok_name LIKE '%경주%'
// 		OR han.hanok_addr LIKE '%경주%')
// 		AND han.hanok_type = "1"
// 		GROUP BY
//       	han.id
//          ,han.hanok_name
//          ,han.hanok_img1
//          ,room.room_price
// 		order by room.room_price;
        //****************************************************************** */
        $query= " SELECT
            han.id
            ,han.hanok_name
            ,han.hanok_img1
            ,room.room_price
            ,COUNT(review.user_id ) AS cnt
            ,AVG(review.rate) AS rate
            FROM hanoks han
                JOIN (SELECT r.hanok_id, MIN(r.room_price) room_price
                        FROM rooms r ";
        if($val_maxPrice === "1000000" ){
            $query .= " WHERE r.room_price >= 0 ";
            Log::debug("최대가격 1000000", [$query]);
            // $prepare[] = 0;
        }else{
            $query .= " WHERE r.room_price >= ?
                        AND r.room_price <= ?";
            $prepare[] = $val_minPrice;
            $prepare[] = $val_maxPrice;
            Log::debug("최대가격 1000000 아닐 때", [$query]);
        }
        // Log::debug("최대가격", [$val_maxPrice]);
        // if(isset($val_maxPrice)){
        // Log::debug("최대가격 확인", [$val_maxPrice]);
        //     $query .= " WHERE r.room_price >= ".$val_minPrice;
        // }else{
        // Log::debug("가격세팅 안하고 넘어갔을 때", [$val_minPrice]);
        //     $query .= " WHERE r.room_price >= 0";
        // }
        // // 최소가격
        // Log::debug("최소가격 ", [$val_minPrice]);
        // if(isset($val_minPrice)){
        // Log::debug("최소가격 확인", [$val_minPrice]);
        //     $query .= " AND r.room_price <= ".$val_maxPrice;
        // }
        // 인원
        Log::debug("인원 ", [$val_count]);
        if(isset($val_count)){
        Log::debug("인원 확인", [$val_count]);
            $query .= " AND r.room_max >= ? ";
            $prepare[] = $val_count;
        }
        // 체크인 / 체크아웃
        Log::debug("체크인,체크아웃 ", [$val_chkIn, $val_chkOut]);
        if(isset($val_chkIn)){
        Log::debug("체크인,체크아웃 확인", [$val_chkIn,$val_chkOut]);
            $query .= " AND r.id NOT IN
                        (SELECT res.room_id
                        FROM reservations res
                        WHERE
                            res.chk_out >  ?
                        AND res.chk_in <  ? )";
            $prepare[] = $val_chkIn;
            $prepare[] = $val_chkOut;
        }
        $query .= " GROUP BY r.hanok_id) room
                    ON han.id = room.hanok_id
                    LEFT JOIN reviews review ON han.id = review.hanok_id ";
        // Log::debug("지역이름", [$val_local]);
        if(isset($val_local)){
        Log::debug("지역이름이 존재할 때", [$val_local]);
            $query .= " WHERE ( han.hanok_name like ?
                        OR han.hanok_addr LIKE ? ) ";
            $prepare[] = "%".$val_local."%";
            $prepare[] = "%".$val_local."%";
            if(isset($val_type)){
            Log::debug("지역이름이 존재하고, 유형이 존재할 때", [$val_local]);
                $query .= " AND han.hanok_type = ? ";
                $prepare[] = $val_type;
            }
        }else{
            if(isset($val_type)){
                Log::debug("지역검색하지 않고, 유형이 존재할 때", [$val_local]);
                $query .= " WHERE han.hanok_type = ? ";
                $prepare[] = $val_type;
            }
        }
            // 호텔 유형
        Log::debug("한옥유형", [$val_type]);
        // if(isset($val_type)){
        // Log::debug("한옥유형", [$val_type]);
        //         $query .= " WHERE han.hanok_type = "."'".$val_type."'";
        // }
                $query .=" GROUP BY
                han.id
                ,han.hanok_name
                ,han.hanok_img1
                ,room.room_price
                order by room.room_price;";
        Log::debug("쿼리", [$query]);
        Log::debug("prepare", [$prepare]);
        // if($val_maxPrice === null && $val_minPrice === null){
        //     $prepare[] = '0';
        // }else{
        //     $prepare[] = $val_minPrice;
        //     $prepare[] = $val_maxPrice;
        // }
        // if(isset($val_count)){
        // Log::debug("인원 확인", [$val_count]);
        //     $query .= " AND r.room_max >= ".$val_count;
        // }
        $result = DB::select($query,$prepare);

        $arr = ['local'         => $val_local
                ,'chkIn'        => $inputChkIn
                ,'chkOut'       => $inputChkOut
                ,'minPrice'     => $val_minPrice
                ,'maxPrice'     => $val_maxPrice
                ,'hanoktype'    => $val_type
                ,'adults'       => $val_adults
                ,'kids'         => $val_kids
                ];
        Log::debug("값 확인", [$arr]);
        $notices = $this->arrayPaginator($result, $req);
        return view('research')
                ->with('searches', $notices)
                ->with('arr',$arr);
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

    //0626 BYJ
    // public function index(Request $req) {
    //     $category =
    // }

}