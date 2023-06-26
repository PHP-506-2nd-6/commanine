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
                <img src="{{asset('/img/hanok2.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('/img/hanok1.jpg')}}" class="d-block w-100" alt="...">
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

{{-- 카테고리 --}}
<div class="nav-border">
    <ul class="gnb clearfix">
        <li class="hotel">
            <a href="/research/pageget?value=0">
                <img src="/img/hotel.png" alt="hotel"></a>
            <p>호텔</p>
        </li>

        <li class="pension">
            <a href="#">
                <img src="/img/pension.png" alt="pension"></a>
            <p>펜션</p>
        </li>

        <li class="guesthouse">
            <a href="#">
                <img src="/img/guesthouse.png" alt="guesthouse"></a>
            <p>게스트하우스</p>
        </li>

        <li class="resort">
            <a href="#">
                <img src="/img/resort.png" alt="resort"></a>
            <p>리조트</p>
        </li>
    </ul>
</div>









{{-- test --}}
<section id="menu2" class="content02">
                <div class="split myCarousel">
                    <div class="inner-wrapper">
<h2 style="text-align:center">인 기 숙 소</h2>
                        <div class="slides-wrapper">
                            <div class="slides content">
                                @foreach($wish as $val2)
                                <div class="slide">
                                    <div class="bodytext">
                                        <h3 class="card-title">{{$val2->hanok_name}}</h3>
                                        <p class="card-text">{{$val2->hanok_local}}</p>
                                        <p class="card-text">별점</p>
                                        <div class="tag">
                                            <p class="card-text">{{number_format($val2->room_price)}}원</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{-- <div class="slide">
                                    <div class="bodytext">
                                        <h2 class="title">animation</h2>
                                        <p class="subtitle">LOCUS는 세계 최고 수준의 3D 애니메이션 제작 역량을 보유하고 <br> 다양한 TV, 극장용 애니메이션 제작을 진행하고 있습니다.</p>
                                        <div class="tag">
                                            <span class="tag_02"># RED SHOES AND THE 7 DWARFS</span>
                                            <span class="tag_02"># RUNNINGMAN</span>
                                            <!--                                            <span class="tag_02"># 유미의 세포</span>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="bodytext">
                                        <h2 class="title">character</h2>
                                        <p class="subtitle">LOCUS는 자체 창작 캐릭터 라이선싱 사업을 통해 <br>다양한 상품과 콘텐츠를 기획/출시하고 있습니다.</p>
                                        <div class="tag">
                                            <span class="tag_03"># BOOTO</span>
                                            <!--                                            <span class="tag_03"># DESIGN</span>-->
                                            <span class="tag_03"># Licensing Business</span>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>


                            <div class="slides photo">
                                @foreach($wish as $val2)
                                <div class="slide">
                                    <div class="image">
                                        <a href="{{route('hanoks.detail', ['id' => $val2->id])}}"><img src="{{asset($val2->hanok_img1)}}" class="card-img-top" alt="..."></a>
                                    </div>
                                </div>
                                @endforeach
                                {{-- <div class="slide">
                                    <div class="image">
                                        <img src="https://img.freepik.com/free-photo/cloud-and-blue-sky_1150-35749.jpg" alt="">
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image">
                                        <img src="https://img.freepik.com/free-photo/cloud-and-blue-sky_1150-35749.jpg" alt="">
                                    </div>
                                </div> --}}
                            </div>

                            {{-- <div class="slides title">
                                <div class="bodytext ">
                                    <a class="link" href="#"><span>자세히 보기</span></a>
                                </div>
                                <div class="bodytext ">
                                    <a class="link" href="#"><span>자세히 보기</span></a>
                                </div>

                                <div class="bodytext ">
                                    <a class="link" href="#"><span>자세히 보기</span></a>
                                </div>
                            </div> --}}
                        </div>

                        <div id="arrows" class="navigation-wrapper">
                            <a href="#" class="navigation-arrow prev"></a>
                            <a href="#" class="navigation-arrow next"></a>
                        </div>
                    </div>
                </div>
            </section>

{{-- 최신숙소 --}}
<div id="carouselExampleControls" class="carousel slide recent" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-inner">
                <h2>최신숙소</h2>
                <div class="carousel-item active">
                    <div class="container d-block w-100">
                        <div class="row row-xxl-3">
                            @foreach($hanok as $val)
                            <div class="col d-flex justify-content-center">
                                <div class="card" style="width: 20rem; border: none;">
                                    <a href="{{route('hanoks.detail', ['id' => $val->id])}}"><img src="{{asset($val->hanok_img1)}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$val->hanok_name}}</h5>
                                        <p class="card-text">{{number_format($val->room_price)}}원</p>
                                        <p class="card-text">{{$val->hanok_local}}</p>
                                        {{-- <span class="ratestar"><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span>
                                        <span>{{isset($val->review) ? substr($val->review,0,4) : "0"}}</span> --}}
                                        {{-- <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: transparent; color: #333;">
                                            예약하기
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev" style="width: 10%;">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" style="width: 10%;">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button> --}}
</div>


</main>

<script src="{{asset('js/main.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4c8256fa0a.js" crossorigin="anonymous"></script>

    
@endsection