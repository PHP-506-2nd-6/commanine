{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views/errors
 * 파일명     : 404.blade.php
 * 이력       : 0625 KMH new
 * *********************************** */ --}}

@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/error.css')}}">
</head>
@section('contents')
    <div class="wrap">
        <div class="msgBox">
            <div class="msg">페이지를 잘못 접근하셨습니다.</div>
            <button type="button"><a href="{{route('main')}}" class="mainLink">메인으로</a></button>
        </div>
    </div>
@endsection