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
@if(session('flg'))
        <div class="container box">
            <div class="loginBox">
                <h2 class="title">로그인</h2>
                <a class="registBtn" href="{{route('users.regist')}}">회원가입</a>
                @include('layout.errors_validate')
                <div class="alertSuc">{!! session()->has('success') ? session('success') : "" !!}</div>
                <form action="{{route('admin.login.post')}}" method="post" class="formBox">
                    @csrf
                    <input type="text" name="email" id="email" placeholder="이메일" autocomplete="off">
                    <input type="password" name="password" id="password" placeholder="비밀번호" autocomplete="off">
                    <button type="submit" class="loginBtn">Log in</button>
                    
                    <a href="{{route('login.kakao')}}" class="kakao admin_kakao"><img src="{{asset('/img/kakao_login.png')}}" alt="카카오아이콘"></a>
                </form>
            <div class="findBox">
                <a href="{{route('users.findId')}}" class="findId">아이디 찾기</a>
                <a href="{{route('users.findPw')}}" class="findPw">비밀번호 찾기</a>
            </div>
            </div>
        </div>
    @else
        
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
                    {{-- <button type="button" onclick="kakaoLogin()"><img src="https://www.gb.go.kr/Main/Images/ko/member/certi_kakao_login.png" alt="카카오아이콘"></button> --}}
                    <a href="{{route('login.kakao')}}" class="kakao"><img src="{{asset('/img/kakao_login.png')}}" alt="카카오아이콘"></a>
                </form>
            <div class="findBox">
                <a href="{{route('users.findId')}}" class="findId">아이디 찾기</a>
                <a href="{{route('users.findPw')}}" class="findPw">비밀번호 찾기</a>
            </div>
            </div>
        </div>
    @endif
@endsection

{{-- <script src="https://developers.kakao.com./sdk/js/kakao.js"></script>
        <script>
            //js key
        	//4699cc71bdf057335511bc15da234da1
            window.Kakao.init("77b8a598458c6d8243e8e4deb19cb111");

            function kakaoLogin(){
                window.Kakao.Auth.login({
                    scope:'profile_nickname, account_email',
                    success: function(authObj){
                        console.log(authObj);
                        window.Kakao.API.request({
                            url:'/v2/user/me',
                            success: res => {
                                const kakao_account = res.kakao_account;
                                console.log(kakao_account);
                                window.location.href = "/users/regist?";
                            }
                        })
                    }
                });

            }
        </script> --}}