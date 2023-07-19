@extends('layout.layout')
{{-- @section('csslinks')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection --}}
{{-- @section('title','Log in') --}}
@section('contents')
<div>
    해당 이메일로 임시비밀번호가 발송되었습니다. 임시비밀번호로 로그인해 주세요.
</div>
{{-- <button type="button" onclick="location.href={{route('users.findPw')}}">비밀번호 찾기</button> --}}
<button type="button" onclick="location.href='{{route('users.login')}}'">로그인 하기</button>
@endsection