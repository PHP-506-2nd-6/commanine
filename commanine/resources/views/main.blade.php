{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : main.blade.php
 * 이력       : 0614 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>

@section('contents')
{{-- 슬라이드 프로모션 배너 --}}
<main>
    <div class="bg"></div>
    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" style="width: 80%; top:-300px; margin:0 auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://cdn.imweb.me/upload/S20201008b3425fabf62b4/02d195cf265f1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://cdn.imweb.me/upload/S20201008b3425fabf62b4/02d195cf265f1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://cdn.imweb.me/upload/S20201008b3425fabf62b4/02d195cf265f1.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</main>
{{-- 카테고리 --}}
<div class="nav-border">
    <ul class="gnb clearfix">
        <li class="hotel">
            <a href="#">
                <img src="/img/hotel.png" alt="hotel"></a>
        </li>

        <li class="pension">
            <a href="#">
                <img src="/img/pension.png" alt="pension"></a>
        </li>

        <li class="guesthouse">
            <a href="#">
                <img src="/img/guesthouse.png" alt="guesthouse"></a>
        </li>

        <li class="resort">
            <a href="#">
                <img src="/img/resort.png" alt="resort"></a>
        </li>
    </ul>
</div>



<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"
    ></script>
@endsection