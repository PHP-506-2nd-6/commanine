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
    <div class="registBox row">
        <h2 class="title">회원가입</h2>
        <form action="{{route('users.regist.post')}}" method="post" class="container text-center" id="formBox">
            @csrf
            <input type="text" name="name" id="name" class="errbox" placeholder="이름" value="{{old('name')}}">
            <div class="errmsg">
                @if($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </div>
            
            

            <input type="text" name="phoneNumber" id="phoneNumber" class="errbox" placeholder="전화번호는 숫자만 입력해 주세요." value="{{old('phoneNumber')}}">
            <div class="errmsg">
                @if($errors->has('phoneNumber'))
                    {{$errors->first('phoneNumber')}}
                @endif
            </div>
            <div class=" emailBox">
                <input type="text" name="email" id="email" placeholder="이메일" value="{{old('email')}}">
                <button type="button" id="emailChkBtn"  class="blackBtn">확인하기</button>
            </div>
            <div id="errMsgId" class="errmsg"></div>
            <input type="password" name="password" id="password" placeholder="비밀번호" class="errbox" >
            <div class="errmsg">
                @if($errors->has('password'))
                    {{$errors->first('password')}}
                @endif
            </div>
            <input type="password" name="passwordChk" id="passwordChk" placeholder="비밀번호 확인" class="errbox">
            <div id="pwChkAlert" class="errmsg"></div>
            <input type="date" name="birth" id="birth" class="errbox" value="{{old('birth')}}">

            <div class="errmsg">
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
            
            <input type="text" name="questAnswer" id="questAnswer" placeholder="질문의 답" class="errbox" value="{{old('questAnswer')}}">
            <div class="errmsg">
                @if($errors->has('questAnswer'))
                    {{$errors->first('questAnswer')}}
                @endif
            </div>
            <div class="btnGroup">
                <button type="submit" class="registBtn col blackBtn" >회원가입</button>
                <button type="button" class="col whiteBtn">취소</button>
            </div>
        </form>
    </div>
</div>
    <script src="{{asset('js/regist.js')}}"></script>
@endsection