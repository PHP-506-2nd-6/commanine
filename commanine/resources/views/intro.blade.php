{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : main.blade.php
 * 이력       : 0614 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/intro.css')}}">
    <link rel="stylesheet" href="{{asset('css/commom.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>

@section('contents')
<div class="intro_wrap">
    <div class="introimgimg">
        <img class="introimg" src="{{asset('/img/intro.jpg')}}" alt="">
        <span class="introp">한옥에 빠지다</span>
    </div>
    <p class="ft-quotation mg-b40"><strong>최근 한옥은 다음과 같은 특징이 재조명되어 아파트와 다세대주택 등 기존 주거의 대안으로 큰 관심을 얻고 있다.</strong></p>
</div>

    
@endsection