{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : findpw.blade.php
 * 이력       : 0613 KMH new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/find.css')}}">
</head>
@section('contents')
    <div class="con">
        <h2>비밀번호 찾기</h2>
        <div class="msgBox">
            @include('layout.errors_validate')
        </div>
        <form action="{{route('users.findPw.post')}}" method="post">
            @csrf
            <input type="text" name="email" id="email" placeholder="이메일" class="findInput">
            <br>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="전화번호" maxlength="11" class="findInput">
            <br>
            <select name="question" size="1" class="findInput">
                    <option value="1">나의 보물1호는 무엇입니까?</option>
                    <option value="2">출생지는 어디 입니까?</option>
                    <option value="3">어머니의 성함은 무엇입니까?</option>
                <option value="4">아버지의 성함은 무엇입니까?</option>
                <option value="5">졸업한 초등학교 이름은 무엇입니까?</option>
                </select>
            <br>
            <input type="text" name="questAnswer" id="questAnswer" placeholder="질문의 답" class="findInput">
            <br>
            <div class="btnGroup">
                <button type="submit" class="blackBtn">비밀번호 찾기</button>
                <button type="button" onclick="location.href='{{route('users.login')}}'" class="whiteBtn">취소</button>
            </div>
        </form>
    </div>
@endsection