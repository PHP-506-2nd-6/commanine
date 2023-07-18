@extends('layout.layout')

@section('contents')
    {{-- <h1></h1> --}}
    <div style="height: 500px; margin-top:50px;">
    {{-- @if(isset($email))
    <span>'카카오로그인이 완료 되었습니다.'</span>
        <p>Email: {{ $email }}</p>
        <p>이름: {{ $username }}</p>
    @else
        <p>No email found.</p>
    @endif --}}
    <p>Email: {{ $email }}</p>

    <button type="button">메인으로</button> {{-- TODO 메인 페이지로 이동 --}}
    </div>
@endsection