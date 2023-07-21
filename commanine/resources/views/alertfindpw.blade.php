@extends('layout.layout')
{{-- @section('csslinks')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection --}}
{{-- @section('title','Log in') --}}
<head>
    <link rel="stylesheet" href="{{asset('css/alertPage.css')}}">
</head>
@section('contents')
<div class="con">
    <div class="msg">
        해당 이메일로 임시비밀번호가
        <br>
        발송되었습니다.
        <br>
        임시비밀번호로 로그인해 주세요.
    </div>
    <div class="btnBox">
        <button type="button" onclick="location.href='{{route('users.login')}}'" class="blackBtn">로그인 하기</button>
    </div>
</div>
@endsection