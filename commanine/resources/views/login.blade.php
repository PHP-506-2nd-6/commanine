{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : login.blade.php
 * 이력       : 0613 KMH new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
{{-- @section('title','Log in') --}}
@section('contents')
<div class="container box">
    <div class="loginBox">
        <h2 class="title">로그인</h2>
        <a class="registBtn" href="{{route('users.regist')}}">회원가입</a>
        @include('layout.errors_validate')
        <div class="alertSuc">{!! session()->has('success') ? session('success') : "" !!}</div>
        <form action="{{route('users.login.post')}}" method="post" class="formBox">
            @csrf
            <input type="text" name="email" id="email" placeholder="이메일" autocomplete="off">
            <input type="password" name="password" id="password" placeholder="비밀번호" autocomplete="off">
            <button type="submit" class="loginBtn">Log in</button>
        </form>
    <div class="findBox">
        <a href="{{route('users.findId')}}" class="findId">아이디 찾기</a>
        <a href="{{route('users.findPw')}}" class="findPw">비밀번호 찾기</a>
    </div>
    </div>
</div>
@endsection