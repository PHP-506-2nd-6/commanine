@extends('layout.layout')

@section('contents')
    <h1>회원탈퇴</h1>
    <span>탈퇴시 복구가 불가능 합니다. 탈퇴하시겠습니까?</span>
    <button type="button">취소</button> {{-- onclick="location.href='{{route('')}}'" 회원 정보 페이지로 이동 --}}
    <button type="button">회원탈퇴</button> {{-- 회원 탈퇴 페이지로 이동 --}}
@endsection