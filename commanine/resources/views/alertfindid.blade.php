@extends('layout.layout')
{{-- @section('csslinks')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection --}}
{{-- @section('title','Log in') --}}
@section('contents')
<div>
귀하의 이메일은 {{session('findId')}}입니다
</div>
<button type="button" onclick="location.href={{route('users.findPw')}}">비밀번호 찾기</button>
<button type="button" onclick="location.href={{route('users.login')}}">로그인 하기</button>
@endsection