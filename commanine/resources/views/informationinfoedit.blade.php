@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/informationinfoedit.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
    @include('layout.sidebar')
    <div class="updateBox">
        <h2>회원 정보 수정</h2>
        <div>
        @include('layout.errors_validate')
            <div class="infoBox">
                <div>이메일</div>
                <div class="infoVal">{{$data->user_email}}</div>
                <div>이름</div>
                <div class="infoVal">{{$data->user_name}}</div>
                <div>생년월일</div>
                <div class="infoVal">{{$data->user_birth}}</div>
            </div>

            <form action="{{route('users.information.info.edit.post')}}" method ="post">
                @csrf
                <div>
                    <label for="user_num">전화번호</label>
                    <input type="text" name="user_num" id="user_num" value="{{$data->user_num}}">
                </div>
                <div>
                    <label for="user_pw">새 비밀번호</label>
                    <input type="password" name="user_pw" id="user_pw">
                </div>
                <div>
                    <label for="user_pwchk">새 비밀번호 확인</label>
                    <input type="password" name="user_pwchk" id="user_pwchk">
                    <input type="hidden" name="flg" value="2">
                </div>
                <div class="btnGroup">
                    <button type="button" class="blackBtn" onclick="location.href='{{route('users.unregist.pwchk')}}'">탈퇴하기</button>
                    <button type="submit" class="whiteBtn">수정하기</button>
                    <button type="button" class="blackBtn" onclick="location.href='{{route('users.information.info')}}'">취소</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection