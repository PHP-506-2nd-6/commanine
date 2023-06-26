@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/pwcert.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
    @include('layout.sidebar')
        <div class="certBox">
            <h2>비밀번호 인증</h2>
            <p>개인 정보 보호를 위해 비밀번호를 한번 더 적어주시기 바랍니다</p>
            @include('layout.errors_validate')
            <form action="{{route('users.unregist.pwchk.post')}}" method="post">
                @csrf
                <input type="hidden" name="pw_flg" value="{{$data}}">
                <input type="text" name="user_pw" placeholder="비밀번호를 적어주세요" class="pwInput">
                <div class="btnGroup">
                    <button type="submit" class="blackBtn">확인</button>
                    <button type="button" class="whiteBtn" onclick="location.href='{{route('users.information.info')}}'">취소</button>
                </div>
            </form>
        </div>
    </div>

@endsection