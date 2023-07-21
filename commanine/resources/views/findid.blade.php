{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : findid.blade.php
 * 이력       : 0613 KMH new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/find.css')}}">
</head>
@section('contents')
    <div class="con">
        <h2>아이디 찾기</h2>
        <div class="msgBox">
            @include('layout.errors_validate')
        </div>
        <form action="{{route('users.findId.post')}}" method="post">
            @csrf
            <input type="text" name="name" id="name" placeholder="이름" value="{{old('name')}}" class="findInput" maxlength="30">
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="전화번호" class="findInput" maxlength="11">
            <select name="question" size="1" class="findInput">
                    <option value="1">나의 보물1호는 무엇입니까?</option>
                    <option value="2">출생지는 어디 입니까?</option>
                    <option value="3">어머니의 성함은 무엇입니까?</option>
                <option value="4">아버지의 성함은 무엇입니까?</option>
                <option value="5">졸업한 초등학교 이름은 무엇입니까?</option>
                </select>
            <input type="text" name="questAnswer" id="questAnswer" placeholder="질문의 답" class="findInput" maxlength="30">
            <div class="btnGroup">
                <button type="submit" class="blackBtn">아이디 찾기</button>
                <button type="button" onclick="location.href='{{route('users.login')}}'" class="whiteBtn">취 소</button>
            </div>
        </form>
    </div>
@endsection