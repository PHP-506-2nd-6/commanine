@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/withdraw.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
    @include('layout.sidebar')
        <div class="withdrawBox">
            <h2>회원 탈퇴</h2>
            <div class="unregistmsg">
            탈퇴시 복구가 불가능 합니다. <br> 탈퇴하시겠습니까?
            </div>
            <div class="btnGroup">
                <form action="{{route('users.information.unregist.comp')}}" method="post">
                    @csrf
                    <button type="submit" class="blackBtn" onclick="alert('탈퇴가 완료되었습니다')">탈퇴하기</button>
                </form>
                {{-- <form action="{{route('users.information.info')}}" method="get"> --}}
                <button type="button" class="whiteBtn" onclick="location.href='{{route('users.information.info')}}'">취소</button>
                {{-- </form> --}}
            </div>
        </div>
    </div>
@endsection