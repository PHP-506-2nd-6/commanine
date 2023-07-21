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
        귀하의 이메일은
        <br>
        {{session('email')}}입니다.
    </div>
    <div class="btnGroup">
        <button type="button" onclick="location.href='{{route('users.findPw')}}'" class="blackBtn">비밀번호 찾기</button>
        <button type="button" onclick="location.href='{{route('users.login')}}'" class="whiteBtn">로그인 하기</button>
    </div>
</div>
@endsection