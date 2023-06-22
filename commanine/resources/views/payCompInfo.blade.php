<?php
{{-- 요일 변환 해주는 변수 지정 --}}
$yoil = array("일","월","화","수","목","금","토");
?>

{{substr($data[0]->chk_in_date,0,10).'('.$yoil[date('w', strtotime(substr($data[0]->chk_in_date,0,10)))].')'.$data[0]->chk_in}}

<div>
    <h1>예약이 완료되었습니다.</h1>
    <p>예약일시 : {{substr($data[0]->updated_at,0,10).' ('.$yoil[date('w', strtotime(substr($data[0]->chk_in_date,0,10)))].') '.substr($data[0]->updated_at,-8)}}</p>
    <p>숙소 예약 번호 : {{$data[0]->id}}</p>
</div>
<div>
    <img src="{{asset($data[0]->room_img1)}}" alt="{{asset($data[0]->hanok_name)}}">
    <p>{{$data[0]->hanok_name}}</p>
    <p>{{$data[0]->room_name.' / '.$data[0]->reserve_adult.'명'}}</p>
    <p>숙소 문의 : {{$data[0]->hanok_num}}</p>
</div>
<div>
    <div>
        <p>체크인</p>
        <p>
            {{substr($data[0]->chk_in_date,0,10).' ('.$yoil[date('w', strtotime(substr($data[0]->chk_in_date,0,10)))].') '.$data[0]->chk_in}}
        </p>
    </div>
    <div>
        <p>체크아웃</p>
        <p>
            {{substr($data[0]->chk_out_date,0,10).' ('.$yoil[date('w', strtotime(substr($data[0]->chk_out_date,0,10)))].') '.$data[0]->chk_out}}
        </p>
    </div>
</div>
<div>
    <p>결제 정보</p>
    <p>상품가격</p>
    <p>{{$data[0]->pay_price}}</p>
    <p>실 결제 금액</p>
    <p>{{$data[0]->pay_price}}</p>
    <p>결제 수단</p>
    <p>{{$data[0]->pay_type}}</p>
</div>
<button type="button" onclick="location.href='{{route('main')}}'">메인 페이지 이동</button>
<button type="button" onclick="location.href='{{route('users.information.reserve')}}">예약 내역 페이지 이동</button>