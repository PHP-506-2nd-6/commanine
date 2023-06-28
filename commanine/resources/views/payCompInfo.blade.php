@extends('layout.layout')
{{-- 요일 변환 해주는 변수 지정 --}}
<?php
$yoil = array("일","월","화","수","목","금","토");
?>
<head>
    <link rel="stylesheet" href="{{asset('css/paycompinfo.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>
@section('contents')
{{-- {{substr($data[0]->chk_in_date,0,10).'('.$yoil[date('w', strtotime(substr($data[0]->chk_in_date,0,10)))].')'.$data[0]->chk_in}} --}}
<div class="main_container">
    <div class="size_container">
        <p class="font_size1">예약이 완료되었습니다.</p>
        <p>예약일시 : {{substr($data[0]->updated_at,0,10).' ('.$yoil[date('w', strtotime(substr($data[0]->chk_in_date,0,10)))].') '.substr($data[0]->updated_at,-8)}}</p>
        <p class="font_size2">숙소 예약 번호 : {{$data[0]->id}}</p>
    </div>
    <div class="flex_container">
        <div class="items"><img src="{{asset($data[0]->room_img1)}}" alt="{{asset($data[0]->hanok_name)}}" class="flex_img"></div>
        <div class="items flex_items2">
            <div class="flex_size1">{{$data[0]->hanok_name}}</div>
            <div class="flex_size2">{{$data[0]->hanok_addr}}</div>
            <div>{{$data[0]->room_name.' / '.$data[0]->reserve_adult.'명'}}</div>
            <div class="flex_size3">숙소 문의 : {{$data[0]->hanok_num}}</div>
        </div>
    </div>
    <div class="flex_container2">
        <div class="items2 flex2_size2">
            <p class="flex2_size1">체크인</p>
            <p>
                {{substr($data[0]->chk_in_date,0,10).' ('.$yoil[date('w', strtotime(substr($data[0]->chk_in_date,0,10)))].') '.$data[0]->chk_in}}
            </p>
        </div>
        <div class="flex2_circle">
            <div class="circle_item">
                1박
            </div>
        </div>
        <div class="items2">
            <p class="flex2_size1">체크아웃</p>
            <p>
                {{substr($data[0]->chk_out_date,0,10).' ('.$yoil[date('w', strtotime(substr($data[0]->chk_out_date,0,10)))].') '.$data[0]->chk_out}}
            </p>
        </div>
    </div>
    <div class="pay_container">
        <p class="pay_font_size1">결제 정보</p>
        <div class="grid_container1">
            <p>상품가격</p>
            <p class="pay_font_size2">{{number_format($data[0]->pay_price)}}</p>
        </div>
        <div class="grid_container1">
            <p>실 결제 금액</p>
            <p class="pay_font_size2 pay_color">{{number_format($data[0]->pay_price)}}</p>
        </div>
        <div class="grid_container1">
            <p>결제 수단</p>
            <p class="pay_font_size3">{{$data[0]->pay_type}}</p>
        </div>
    </div>
    <div class="btn_group">
    <button type="button" class="btn1" onclick="location.href='{{route('main')}}'">예약 확인</button>
    <button type="button" class="btn2" onclick="location.href='{{route('users.information.reserve')}}'">예약 내역 보기</button>
    </div>
</div>
@endsection