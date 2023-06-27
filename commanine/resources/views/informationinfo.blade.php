@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/informationinfo.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="infoBox">
            <h2>회원 정보</h2>
            <div class="reserve_con reserve_wrap">
                <div>이메일</div>
                <div>{{$data->user_email}}</div>
                <div>이름</div>
                <div>{{$data->user_name}}</div>
                <div>전화번호</div>
                <div>{{$data->user_num}}</div>
                <div>생년월일</div>
                <div>{{$data->user_birth}}</div>
                <button type="button" onclick="location.href='{{route('users.information.pwchk')}}'" class="updateBtn">회원 정보 수정</button>
            </div>
        </div>
    </div>


@endsection