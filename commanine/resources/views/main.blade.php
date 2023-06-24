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
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"> --}}
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
            <a href="#">
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
{{-- <section id="menu2" class="content02">
                <div class="split myCarousel">
                    <div class="inner-wrapper">
                        <div class="slides-wrapper">
                            <div class="slides content">
                                <div class="slide">
                                    <div class="bodytext">
                                        <h2 class="title">vfx</h2>
                                        <p class="subtitle">LOCUS는 최고의 VFX 기술을 보유하고 모든 미디어 플랫폼을 위한 <br> 컨텐츠 제작 및 크리에이티브 솔루션을 제공합니다.</p>
                                        <div class="tag">
                                            <span class="tag_01"># 3D Animation</span>
                                            <!--                                            <span class="tag_01"># Visual Experience</span>-->
                                            <span class="tag_01"># Game Cinematic</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="slide">
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
                                </div>
                            </div>


                            <div class="slides photo">
                                <div class="slide">
                                    <div class="image">
                                        <img src="https://img.freepik.com/free-photo/cloud-and-blue-sky_1150-35749.jpg" alt="">
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image">
                                        <img src="https://img.freepik.com/free-photo/cloud-and-blue-sky_1150-35749.jpg" alt="">
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image">
                                        <img src="https://img.freepik.com/free-photo/cloud-and-blue-sky_1150-35749.jpg" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="slides title">
                                <div class="slide red">
                                    <div class="bodytext ">
                                        <a class="link" href="#"><span>View more</span></a>
                                    </div>
                                </div>
                                <div class="slide blue">
                                    <div class="bodytext ">
                                        <a class="link" href="#"><span>View more</span></a>
                                    </div>
                                </div>
                                <div class="slide green">
                                    <div class="bodytext ">
                                        <a class="link" href="#"><span>View more</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="arrows" class="navigation-wrapper">
                            <a href="#" class="navigation-arrow prev"><i class="far fa-caret-square-left" aria-hidden="true"></i></a>
                            <!--                            <span>.</span>-->
                            <a href="#" class="navigation-arrow next"><i class="far fa-caret-square-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </section> --}}












{{-- 인기숙소 --}}
<div id="carouselExample" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-inner">
                <h3>인 기 숙 소</h3>
                <div class="carousel-item active">
                    <div class="container d-block w-100">
                        <div class="row row-xxl-3">
                            @foreach($wish as $val2)
                            <div class="col d-flex justify-content-center">
                                <div class="card" style="width: 20rem;">
                                    <a href="{{route('hanoks.detail', ['id' => $val2->id])}}"><img src="{{asset($val2->hanok_img1)}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$val2->hanok_name}}</h5>
                                        <p class="card-text">{{number_format($val2->room_price)}}원</p>
                                        <p class="card-text">{{$val2->hanok_local}}</p>
                                        <p class="card-text">별점</p>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev" style="width: 10%;">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" style="width: 10%;">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
</div>

{{-- 최신숙소 --}}
<div id="carouselExampleControls" class="carousel slide recent" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-inner">
                <h3>최신숙소</h3>
                <div class="carousel-item active">
                    <div class="container d-block w-100">
                        <div class="row row-xxl-3">
                            @foreach($hanok as $val)
                            <div class="col d-flex justify-content-center">
                                <div class="card" style="width: 20rem;">
                                    <a href="{{route('hanoks.detail', ['id' => $val->id])}}"><img src="{{asset($val->hanok_img1)}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$val->hanok_name}}</h5>
                                        <p class="card-text">{{number_format($val->room_price)}}원</p>
                                        <p class="card-text">{{$val->hanok_local}}</p>
                                        <p class="card-text">별점</p>
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



 <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                해당 상품을 장바구니에 담겠습니까?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
            <button type="button" class="btn btn-primary">장바구니 담기</button>
            </div>
        </div>
        </div>
    </div> --}}


</main>

<script src="{{asset('js/main.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4c8256fa0a.js" crossorigin="anonymous"></script>

    
@endsection