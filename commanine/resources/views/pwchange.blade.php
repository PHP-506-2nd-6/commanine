@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/pwchange.css')}}">
</head>
@section('contents')
        <div class="pwBox">
            <h2>비밀번호 변경</h2>
            <p class="info">개인 정보 보호를 위해 임시 비밀번호를<br>변경해 주시기 바랍니다</p>
            <div class="msgBox">@include('layout.errors_validate')</div>
            <form action="{{route('users.pwchange.post')}}" method="post">
                @csrf
                <input type="password" name="password" placeholder="변경할 비밀번호 8~20자" id="password" class="pwInput" maxlength="20">
                <div id="pwAlert"></div>
                <input type="password" name="passwordChk" placeholder="비밀번호 확인" id="passwordChk" class="pwInput" maxlength="20">
                <div id="pwChkAlert"></div>
                <div class="btnGroup">
                    <button type="submit" id="submitBtn" class="blackBtn">비밀번호 변경</button>
                </div>
            </form>
        </div>
    <script src="{{asset('js/pwchange.js')}}"></script>
@endsection