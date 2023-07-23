{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : main.blade.php
 * 이력       : 0614 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/commom.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>

@section('contents')
{{-- 슬라이드 프로모션 배너 --}}
<main>
    <div class="bg"></div>
    <div id="carouselExampleControlsNoTouching" class="carousel slide mainslide" data-bs-touch="false" style="width: 80%; top:-300px; margin:0 auto;">
        <div class="carousel-inner " data-bs-ride="carousel">
            <div class="carousel-item active" data-bs-interval="2000">
                <a class="menu_hanok" href="{{route('intro')}}"><img src="{{asset('/img/hanok2.jpg')}}" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <a class="menu_hanok" href="{{route('intro')}}"><img src="{{asset('/img/hanok1.jpg')}}" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <a class="menu_hanok" href="{{route('intro')}}"><img src="https://cdn.imweb.me/upload/S20201008b3425fabf62b4/02d195cf265f1.png" class="d-block w-100" alt="..."></a>
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

{{-- 카테고리 --}}
<section id="menu1" class="nav-border">
{{-- <div class="nav-border"> --}}
    <ul class="gnb clearfix">
        <li class="cate hotel">
            <a href="/research/pageget?hanokType=0">
                <img src="/img/hotel.png" alt="hotel"></a>
            <p>호텔</p>
        </li>

        <li class="cate pension">
            <a href="/research/pageget?hanokType=1">
                <img src="/img/pension.png" alt="pension"></a>
            <p>펜션</p>
        </li>
        <li class="cate guesthouse">
            <a href="/research/pageget?hanokType=2">
                <img src="/img/guesthouse.png" alt="guesthouse"></a>
            <p>게스트하우스</p>
        </li>

        <li class="cate resort">
            <a href="/research/pageget?hanokType=3">
                <img src="/img/resort.png" alt="resort"></a>
            <p>리조트</p>
        </li>

    </ul>
{{-- </div> --}}
</section>

{{-- 인기숙소 --}}
<section id="menu2" class="content02">
                <div class="split myCarousel">
                    <div class="inner-wrapper">
                        <h4 style="text-align:center">popularity</h4>
                        <div class="slides-wrapper">
                            <div class="slides content">
                                @foreach($wish as $val2)
                                <div class="slide">
                                    <div class="bodytext">
                                        <h3 class="card-title">{{$val2->hanok_name}}
                                        <p class="card-text" style="padding-top:5px;">{{$val2->hanok_local}}</p></h3>
                                        <p class="card-text comment">{{$val2->hanok_comment}}</p>
                                        {{-- <span class="ratestar"><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span>
                                        <span>{{isset($val2->review) ? substr($val2->review,0,4) : "0"}}</span> --}}
                                            <a class="more" href="{{route('hanoks.detail', ['id' => $val2->id])}}">자세히보기</a>
                                        <div class="tag">
                                            <p class="card-text">{{number_format($val2->room_price)}}원</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="slides photo">
                                @foreach($wish as $val2)
                                <div class="slide">
                                    <div class="image">
                                        <a href="{{route('hanoks.detail', ['id' => $val2->id])}}"><img src="{{asset($val2->hanok_img1)}}" class="card-img-top" alt="..."></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="arrows" class="navigation-wrapper">
                            <a href="#" class="navigation-arrow prev"></a>
                            <a href="#" class="navigation-arrow next"></a>
                        </div>
                    </div>
                </div>
            </section>

<div class="bannerevent">
{{-- <img src="{{asset('/img/hanok2.jpg')}}" alt="#"> --}}
</div>

{{-- 최신숙소 --}}
<section id="menu3" class="content03">
<div id="carouselExampleControls" class="carousel slide recent" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-inner">
                <h4>RANKING</h4>
                <div class="carousel-item active">
                    <div class="container d-block w-100">
                        <div class="row row-xxl-3">
                            @foreach($hanok as $val)
                            <div class="col d-flex justify-content-center">
                                <div class="card" style="width: 20rem; border: none;">
                                    <a href="{{route('hanoks.detail', ['id' => $val->id])}}"><img src="{{asset($val->hanok_img1)}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <div class="card_top">
                                            <h5 class="card-title">{{$val->hanok_name}}
                                            <p class="card-text" style="font-size:15px">{{$val->hanok_local}}
                                            <span>{{isset($val->review) ? number_format($val->review,1) : "0"}}</span>
                                            <span class="ratestar"><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span></p></h5>
                                        </div>
                                        <div class="card_bottom">
                                            <p class="card-text">{{number_format($val->room_price)}}원</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
</div>
</section>

</main>

<script src="{{asset('js/main.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4c8256fa0a.js" crossorigin="anonymous"></script>

    
@endsection