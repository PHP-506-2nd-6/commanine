{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminReviewUp.blade.php
 * 이력       : 0724 BYJ new
 * *********************************** */ --}}
@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminReserve.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
</head>
@section('contents')
    <div class="container row main-container" style="max-width:2000px">
        @include('layout.adminsidebar')
        <div class="container col-9 content-box">
            <h2 class="reserve_title">예약수정</h2>
            {{-- <form action="{{ route('admin.reservation.up', ['reserve_id' => $reservations->reserve_id]) }}" method="POST"> --}}
            <form action="{{ route('admin.reservation.up', ['reserve_id' => $reservations->reserve_id]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="reserveup">
                    <label for="">예약번호</label>
                    <input style="border: 0; outline:none;" type="text" name="reserve_id" value="{{$reservations->reserve_id}}" readonly>
                    <br>
                    <label for="hanok">숙소명/객실명</label>
                    <input style="border: 0; outline:none;" type="text" name="hanok_name" id="hanok" value="{{ $reservations->hanok_name }}/{{ $reservations->room_name }}" readonly>
                    <br>
                    <label for="reserve_name" class="require">예약자 이름</label>
                    <input type="text" name="reserve_name" id="reserve_name" value="{{$reservations->reserve_name}}" required>
                    <br>
                    <label for="reserve_num" class="require">예약자 번호</label>
                    <input type="text" name="reserve_num" id="reserve_num" value="{{$reservations->reserve_num}}" required>
                    <br>
                    <label for="">예약일시</label>
                    <input style="border: 0; outline:none;" type="text" name="reserve_id" value="{{$reservations->created_at}}" readonly>
                    <br>
                    <label for="">체크인/체크아웃</label>
                    <input style="border: 0; outline:none;" type="text" name="chk" value="{{$reservations->chk_in}}~{{$reservations->chk_out}}" readonly>
                    <br>
                    <label for="">인원(성인/아동)</label>
                    <input style="border: 0; outline:none;" type="text" name="reserve_adult" value="{{$reservations->reserve_adult}}/{{$reservations->reserve_child}}" readonly>
                    <br>
                    <label for="">가격</label>
                    <input style="border: 0; outline:none;" type="text" name="room_price" value="{{$reservations->room_price}}" readonly>
                    <br>
                    <label for="reserve_flg" class="require">예약상태</label>
                    <select name="reserve_flg" id="reserve_flg">
                        <option value="1" @if($reservations->reserve_flg == 1) selected @endif>예약완료</option>
                        <option value="0" @if($reservations->reserve_flg == 0) selected @endif>예약대기</option>
                    </select>
                </div>

                <div class="bnt_wrap">
                    <button class="btn btn-dark" type="submit">수정 완료</button>
                    <button class="btn btn-secondary" type="button" onclick="history.back()">취소</button>
                </div>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/adminreserve.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection