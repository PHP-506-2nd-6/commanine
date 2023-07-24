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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@section('contents')
<div class="container box">
    <div class="registBox">
        <h2 class="title">회원가입</h2>
        <form action="{{route('users.regist.post')}}" method="post" class="form-box" id="formBox">
            @csrf
            <input type="text" onblur="checkName()" name="name" id="name" autocomplete="off" class="errbox nameInput" placeholder="이름" value="{{old('name')}}" maxlength="30" required>
            <div class="errmsg nameAlert">
                @if($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </div>
            
            

            <input type="text" onblur="checkNum()" name="phoneNumber" autocomplete="off" id="phoneNumber" class="errbox numInput" placeholder="전화번호는 숫자만 입력해 주세요." value="{{old('phoneNumber')}}" maxlength="11" required>
            <div class="errmsg numAlert">
                @if($errors->has('phoneNumber'))
                    {{$errors->first('phoneNumber')}}
                @endif
            </div>
            <div class="emailBox">
                <input type="text" name="email" onblur="checkEmail()"  class="emailInput" autocomplete="off" id="email" placeholder="이메일" value="{{old('email')}}" maxlength="30" required>
                <button type="button" id="emailChkBtn" class="blackBtn">인증번호 발송</button>
            </div>
            <div id="errMsgId" class="errmsg emailAlert"></div>
            <div class="emailChkNumBox">
                <input type="text" name="emailChkNum" onblur="emailNumChk()"  class="emailChkNum" autocomplete="off" id="emailChkNum" placeholder="인증번호" disabled="true" required>
                <button type="button" id="emailChkNumBtn" class="blackBtn" disabled="true">인증하기</button>
                <span id="timet"></span>
            </div>
            <div id="errMsgEmailChkNum" class="errmsg emailChkNumAlert"></div>
            <input type="password" name="password" onblur="checkPw()" autocomplete="off" id="password" placeholder="비밀번호 8~20자" class="errbox pwInput" maxlength="20" required>
            <div class="errmsg pwAlert">
                @if($errors->has('password'))
                    {{$errors->first('password')}}
                @endif
            </div>
            <input type="password" name="passwordChk" autocomplete="off" id="passwordChk" placeholder="비밀번호 확인" class="errbox" maxlength="20" required>
            <div id="pwChkAlert" class="errmsg"></div>
            <input type="date" name="birth" id="birth" onblur="checkBirth()" autocomplete="off" class="errbox birthInput" value="{{old('birth')}}">

            <div class="errmsg birthAlert">
                @if($errors->has('birth'))
                    {{$errors->first('birth')}}
                @endif
            </div>
            <select name="question" size="1" >
                <option value="1">나의 보물1호는 무엇입니까?</option>
                <option value="2">출생지는 어디 입니까?</option>
                <option value="3">어머니의 성함은 무엇입니까?</option>
                <option value="4">아버지의 성함은 무엇입니까?</option>
                <option value="5">졸업한 초등학교 이름은 무엇입니까?</option>
            </select>
            
            <input type="text" name="questAnswer" onblur="checkAnswer()" autocomplete="off" id="questAnswer" placeholder="질문의 답" class="errbox answerInput" value="{{old('questAnswer')}}" maxlength="30" required>
            <div class="errmsg answerAlert">
                @if($errors->has('questAnswer'))
                    {{$errors->first('questAnswer')}}
                @endif
            </div>
            <div class="btnGroup">
                <button type="submit" class="registBtn col blackBtn" >회원가입</button>
                <button type="button" class="col whiteBtn" onclick="location.href='{{route('main')}}'">취소</button>
            </div>
        </form>
    </div>
</div>
    <script src="{{asset('js/regist.js')}}"></script>
@endsection