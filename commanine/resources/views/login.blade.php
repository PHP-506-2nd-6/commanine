{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : login.blade.php
 * 이력       : 0613 KMH new
 * *********************************** */ --}}
@extends('layout.layout')

@section('title','Log in')
@section('contents')
    <a href="{{route('users.regist')}}">회원가입</a>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <input type="text" name="email" id="email" placeholder="아이디">
        <input type="password" name="password" id="password" placeholder="비밀번호">
        <button type="submit">Log in</button>
    </form>
    <a href="{{route('users.findId')}}">아이디 찾기</a>
    <a href="{{route('users.findPw')}}">비밀번호 찾기</a>
@endsection