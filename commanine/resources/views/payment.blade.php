@extends('layout.layout')
<?php
    {{-- 체크인 체크아웃 계산 --}}
    $from = new Datetime($data->chk_in);
    $to = new Datetime($data->chk_out);
    $gap = date_diff( $from, $to )->days;
?>
<head>
    <link rel="stylesheet" href="{{asset('css/payment.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>
@section('contents')
<div class="paymentInfo">
    <div class="roomName">
        <p class="hanokName">{{$data->hanok_name}}</p>
        <p>{{$data->room_name}}</p>
    </div>
    <form action="{{route('users.payment.comp')}}" method="post">
    @csrf
    <div class="payContainer">
        <div class="items">
            <div class="font_size">체크인</div>
            <input type="hidden" name="chk_in_date" id="chk_in_date" value="{{$data->chk_in}}">
            <div>{{$data->chk_in}}</div>
        </div>
        <div class="items">
            <div class="font_size">체크아웃</div>
            <input type="hidden" name="chk_out_date" id="chk_out_date" value="{{$data->chk_out}}">
            <div>{{$data->chk_out}}</div>
        </div>
    </div>
</div>

<div class="reserveInfo">
    <div class="reservetitle">
        <p class="border_line">예약자 정보</p>
        <input type="hidden" name="room_id" id="room_id" value="{{$data->room_id}}">
        <input type="hidden" name="reserve_adult" id="reserve_adult" value="{{$data->reserve_adult}}">
        <input type="hidden" name="reserve_child" id="reserve_child" value="{{$data->reserve_child}}">
        {{-- 0629 ysh 시간되면 css 바꾸기 --}}
        <input type="hidden" name="reserve_price" value="{{number_format($gap * (int)$data->room_price)}}">
        @include('layout.errors_validate')
        <label for="reserve_name">예약자 이름</label>
        <br>
        <input type="text" name="reserve_name" id="reserve_name" placeholder="한글로 성명을 입력해주세요" autocomplete="off"'>
        <div id="reserve_name_inner"></div>
        <br>
        <label for="reserve_num">예약자 전화 번호</label>
        <br>
        <input type="text" name="reserve_num" id="reserve_num" placeholder="'-' 없이 숫자로 전화번호를 입력해주세요" autocomplete="off">
        <div id="reserve_num_inner"></div>
    </div>
    <div class="reservetitle pay_padding">
        <p>결제 금액</p>
        <div class="pay_sum">
            <span>상품 금액 :</span>
            <span class="span_padding_1">{{number_format($gap * (int)$data->room_price)}}</span>
            <br>
            <span>총 결제 금액 :</span>
            <span class="span_padding_2">{{number_format($gap * (int)$data->room_price)}}</span>
            {{-- 0629 ysh 시간되면 span 대신 input 넣어서 교체 --}}
            {{-- <input type="text" name="reserve_price" value="{{number_format($gap * (int)$data->room_price)}}"> --}}
        </div>
    </div>
    <div class="reservetitle pay_padding">
        <span>결제 수단</span>
        <span class="pay_padding_select">
            <select name="pay_type" class="pay_type">
                <option value="신용카드">신용카드</option>
            </select>
        </span>
    </div>
    <div class="pay_padding">
        <input type='checkbox' name='selectall' value='selectall' onclick='selectAll(this)' required />
        <span class="font_size">필수 약관 전체 동의</span>
        <br>
        <input type='checkbox' name='animal' value='dog' onclick='checkSelectAll()' required />
        만 14세 이상 이용 동의
        <br>
        <input type='checkbox' name='animal' value='cat' onclick='checkSelectAll()' required />
        개인 정보 수집 동의
        <br>
        <input type='checkbox' name='animal' value='rabbit' onclick='checkSelectAll()' required />
        개인 정보 제 3자 제공 동의
    </div>
    <br>
    <br>
    
    <div class="btn_group">
    <button type="submit" class="btn1">예약하기</button>
    <button type="button" class="btn2" onclick="location.href='{{route('hanoks.detail', ['id' => $data->hanok_id])}}'">취소</button>
    </div>
    </form>
</div>

<script src="{{asset('js/payment.js')}}"></script>
@endsection