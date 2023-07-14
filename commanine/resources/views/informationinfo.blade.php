@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/informationinfo.css')}}"> 
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="infoBox">
            <h2>회원 정보</h2>
            <div class="reserve_con reserve_wrap">
                <div class="item1">이메일</div>
                <div class="item2">{{$data->user_email}}</div>
                <div class="item1">이름</div>
                <div class="item2">{{$data->user_name}}</div>
                <div class="item1">전화번호</div>
                <div class="item2">{{$data->user_num}}</div>
                <div class="item1">생년월일</div>
                <div class="item2">{{$data->user_birth}}</div>
                <button type="button" onclick="location.href='{{route('users.information.pwchk')}}'" class="updateBtn">회원 정보 수정</button>
            </div>
        </div>
    </div>


@endsection