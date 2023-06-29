@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>
@section('contents')
    <div class="con">
        <div class="hanok">
            <div class="imgBox">
                <div id="carouselIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset($hanok->hanok_img1)}}" class="d-block w-100" alt="{{$hanok->hanok_name}}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset($hanok->hanok_img2)}}" class="d-block w-100" alt="{{$hanok->hanok_name}}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset($hanok->hanok_img3)}}" class="d-block w-100" alt="{{$hanok->hanok_name}}">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        <div class="hanokInfo">
            <p class="hanok_name">{{$hanok->hanok_name}}</p>
            <i class="fa-solid fa-star star"></i>
            <span class="rate">{{number_format($rate->rate, 1)}}</span>
            <button type='button'>
                <i class="fa-solid fa-heart heart"></i>
            </button>
            <span class="rate">{{$likes->likes}}</span>
            <br>
            <span>{{$hanok->hanok_addr}}</span>
            <div class="hanokComment"><span>{!! nl2br($hanok->hanok_comment) !!}</span></div>
        </div>
        </div>
        <div class="detailCon">
        <div class="tabBox">
            <button type="button" class="tabBtn roomBtn">객실선택</button>
            <button type="button" class="tabBtn">위치</button>
            <button type="button" class="tabBtn">숙소안내</button>
            <button type="button" class="tabBtn revBtn">후기</button>
            <div class="line"></div>
        </div>
        <div class="conBox">
            <div class="content roomCon">
                <form id="frm" method="get" action="">
                    <div class="filter_form">
                        <div class="dateCon">
                            <i class="fa-regular fa-calendar-check icon1"></i>
                            <label for="chk_in">체크인</label>
                            <input type="text" name="chk_in" class="datepicker inpDate" value="{{$inpData['val_chkIn']}}" autocomplete="off" readonly>
                        </div>
                        <div class="dateCon">
                            <i class="fa-regular fa-calendar-check icon2"></i>
                            <label for="chk_out">체크아웃</label>
                            <input type="text" name="chk_out" class="datepicker2 inpDate" value="{{$inpData['val_chkOut']}}" autocomplete="off" readonly>
                        </div>
                        <div class="countWrap searchWidth">
                            <i class="fa-solid fa-user icon3"></i>
                            <div class="countPeople">
                                <label for="countP">인원</label>
                                <input type="text" class="countInput" id="countP" value="성인 : {{$inpData['val_adult']}} / 어린이 : {{$inpData['val_child']}}"/>
                            </div>
                            <div class="countBox poAbsolute">
                                <div class="adultsBox">
                                    <label for="adults">성인</label>
                                    <div >
                                        <button class="minBtn" type="button">-</button>
                                        <input type="number" value="{{$inpData['val_adult']}}" class="adultsVal" id="adults" min="1" max="16">
                                        <button class="plusBtn" type="button">+</button>
                                    </div>
                                </div>
                                <div class="kidsBox">
                                    <label for="kids">어린이</label>
                                    <div>
                                        <button class="minBtn" type="button">-</button>
                                        <input type="number" value="{{$inpData['val_child']}}" class="kidsVal" id="kids" min="0" max="16">
                                        <button class="plusBtn" type="button">+</button>
                                    </div>
                                </div>
                                <button type="button" class="countChkBtn">확인</button>
                            </div>
                        </div>
                        <button type="submit" class="searchBtn">검색</button>
                    </div>
                    <input type="hidden" name="room_id" class="room_id" disabled="true">
                    @php($i = 0)
                    @forelse($rooms as $val)
                        <div class="room">
                            <div>
                                <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}" class="roomImg">
                            </div>
                            <div class="room2">
                                <div class="room3">
                                    <h4>{{$val->room_name}}</h4>
                                    <span>가격 {{number_format($val->room_price)}} / 1박</span>
                                </div>
                                <button type="button" class="roomInfoBtn"data-bs-toggle="modal" data-bs-target="#exampleModal{{$i++}}">객실 이용 안내
                                    <i class="fa-solid fa-chevron-right chevron"></i>
                                </button>
                                <button type="button" class="reserveBtn" value="{{$val->id}}">예약하기</button>
                            </div>
                        </div>
                    <input type="hidden" placeholder="성인" name="reserve_adult" id="adults" class="adultsHide" value="{{$inpData['val_adult']}}">
                    <input type="hidden" placeholder="아동" name="reserve_child" id="kids" class="kidsHide" value="{{$inpData['val_child']}}">
                </form>
                @empty
                <div class="msg">선택하신 날짜에 예약 가능한 객실이 없습니다. 날짜를 다시 선택해주세요</div>
                @endforelse
            </div>
            <div class="content">
                <div id="map"></div>
                <div class="addrBox">
                    <i class="fa-solid fa-location-pin pin"></i>
                    <span class="addr">{{$hanok->hanok_addr}}</span>
                    <button type="button" class="copy">주소복사</button>
                </div>
            </div>
            <div class="content">
                <div class="service">
                    <p class="serv">편의 시설 및 서비스</p>
                    <div class="amenityInfo">
                    @foreach($amenities as $val)
                        <div class="amenityCon">
                            <img src="{{asset($val->icon_img)}}" alt="{{$val->amenity_name}}" class="amenities">
                            <br>
                            <span>{{$val->amenity_name}}</span>
                        </div>
                    @endforeach
                    </div>
                    <p class="serv2">기본정보</p>
                    <div class="roomCom">
                        <h5>숙소 안내</h5>
                        <div>
                            {!! nl2br($hanok->hanok_info) !!}
                        </div>
                            <h5>환불정책</h5>
                        <div>
                            {!! nl2br($hanok->hanok_refund) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="content revCon">
                <div class="revInfo">
                    <strong>이용 후기({{$rate->rev_cnt}})</strong>
                    <div class="rateCon">
                        <div class="product-review-stars-container">
                            <strong class="rateComment"></strong>
                            <div class="stars-outer">
                                <div class="stars-inner" id="stars-inner"></div>
                            </div>
                        <strong class="rate">{{number_format($rate->rate, 1)}}</strong>
                        <span> / 5</span>
                        </div>
                        <span>누적 평균 점수</span>
                    </div>
                </div>
                @forelse($reviews as $item)
                    <div class="review">
                        <h5>{!! nl2br($item->rev_content) !!}</h5>
                        <i class="fa-solid fa-star revStar"></i>
                        <span>{{$item->rate}}</span>
                        <span>{{(substr($item->created_at, 0, 10))}}</span>
                    </div>
                @empty
                <div class="msg">아직 리뷰가 작성되지 않았습니다.</div>
                @endforelse
                <div class="d-flex justify-content-center pageCon" > 
                    {{ $reviews->withQueryString()->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
        </div>
        @php($j = 0)
        @foreach($rooms as $item)
        <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$j}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong>객실 이용 안내</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modalCon">
                                <div class="modalImg">
                                    <div id="carouselExampleIndicators{{$j}}" class="carousel slide" data-bs-ride="true">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleIndicators{{$j}}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators{{$j}}" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators{{$j}}" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{asset($item->room_img1)}}" class="d-block w-100" alt="{{$item->room_name}}">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset($item->room_img2)}}" class="d-block w-100" alt="{{$item->room_name}}">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset($item->room_img3)}}" class="d-block w-100" alt="{{$item->room_name}}">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$j}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$j++}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="roomInfo">
                                    <h3>{{$item->room_name}}</h3>
                                    <div>체크인 {{$item->chk_in}} 체크아웃 {{$item->chk_out}}</div>
                                    <div>기준 {{$item->room_min}}인 / 최대 {{$item->room_max}}인</div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <strong>기본 정보</strong>
                                <div>{!! nl2br($item->room_content) !!}</div>
                                <div>{!! nl2br($item->room_detail) !!}</div>
                            <hr>
                                <strong>편의 시설</strong>
                                <div>{!! nl2br($item->room_facility) !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <input type="hidden" name="longitude" id="longitude" value="{{$hanok->longitude}}" disabled>
    <input type="hidden" name="latitude" id="latitude" value="{{$hanok->latitude}}" disabled>

    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=c13a45bd5670fc2f9682582b81e72b29"></script>
    <script src="https://kit.fontawesome.com/da11601548.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/05d390fd09.js"></script>
    <script src="{{asset('js/detail.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection