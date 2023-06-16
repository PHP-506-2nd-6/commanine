{{--
 /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : regist.blade.php
 * 이력       : 0613 KMH new
 * *********************************** */ 
 --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/regist.css')}}">
</head>
@section('contents')
<div class="container box">
    <div class="registBox">
        <h2 class="title">회원가입</h2>
        @include('layout.errors_validate')
        <form action="{{route('users.regist.post')}}" method="post" class="formBox">
            @csrf
            <input type="text" name="name" id="name" placeholder="이름" >

            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="전화번호">

            <input type="text" name="email" id="email" placeholder="이메일" >
            <button type="button" id="emailChkBtn" >확인하기</button>
            <div id="errMsgId"></div>
            <input type="password" name="password" id="password" placeholder="비밀번호">

            <input type="password" name="passwordChk" id="passwordChk" placeholder="비밀번호 확인">
            <div id="pwChkAlert"></div>
            <input type="date" name="birth" id="birth" >

            <select name="question" size="1">
                <option value="1">나의 보물1호는 무엇입니까?</option>
                <option value="2">출생지는 어디 입니까?</option>
                <option value="3">어머니의 성함은 무엇입니까?</option>
                <option value="4">아버지의 성함은 무엇입니까?</option>
                <option value="5">졸업한 초등학교 이름은 무엇입니까?</option>
            </select>

            <input type="text" name="questAnswer" id="questAnswer" placeholder="질문의 답">
            <br>
            <button type="submit" class="registBtn">회원가입</button>
            <button type="button">취소</button>
        </form>
    </div>
</div>

    <script src="{{asset('js/regist.js')}}"></script>
@endsection