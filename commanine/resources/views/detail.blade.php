@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>
@section('contents')
    <div class="hanokInfo">
        <div style="overflow:hidden; width:450px;" class="imgBox">
            {{-- <div> --}}
                {{-- <img src="{{asset($hanok->hanok_img1)}}" alt="{{$hanok->hanok_name}}" class="img"> --}}
            {{-- </div> --}}
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
    <div style="border:1px black solid;">
        <h5>{{$hanok->hanok_name}}</h5>
        <img src="/img/icon/star.png" alt="별점" style="width:16px; height:16px">
        <span>{{number_format($rate->rate, 1)}}</span>
        <button type='button'>
            <img src="{{asset('img/icon/heart.png')}}" alt="찜" class="like">
        </button>
        <span>{{$likes->likes}}</span>
        <br>
        <span>{{$hanok->hanok_addr}}</span>
        <div style="border:1px black solid;"><span>{!! nl2br($hanok->hanok_comment) !!}</span></div>
    </div>
</div>
<div class="detailCon">
    <div class="tabBox">
        <button type="button" class="tabBtn active">객실선택</button> {{-- TODO 탭 메뉴 기본적으로 객실선택 --}}
        <button type="button" class="tabBtn">위치</button>
        <button type="button" class="tabBtn">숙소안내</button>
        {{-- <button type="button" class="tabBtn">서비스</button>
        <button type="button" class="tabBtn">안내/정책</button> --}}
        <button type="button" class="tabBtn">후기</button>
        <div class="line"></div>
    </div>
    <div class="conBox">
        <div class="content active">
            <form id="frm" method="get" action="">
                <div class="search_form">
                    <div class="search_form2">
                        {{-- <label for="chkIn">체크인</label>
                        <input type="date" id="chkIn" name="chk_in" value="{{$inpData['val_chkIn']}}">
                        <label for="chkOut">체크아웃</label>
                        <input type="date" id="chkOut" name="chk_out" value="{{$inpData['val_chkOut']}}"> --}}
                        <label for="chk_in">체크인</label>
                        <input type="text" name="chk_in" class="datepicker" value="{{$inpData['val_chkIn']}}" required>
                        <label for="chk_out">체크아웃</label>
                        <input type="text" name="chk_out" class="datepicker2" value="{{$inpData['val_chkOut']}}">
                        <span>성인</span>
                        <input type="number" min="1" max="16" value="{{$inpData['val_adult']}}" id="adult" name="reserve_adult">
                        <span>아동</span>
                        <input type="number" min="0" max="16" value="{{$inpData['val_child']}}" id="child" name="reserve_child">
                    </div>
                    <button type="submit" class="searchBtn">검색</button>
                </div>
                <input type="hidden" name="room_id" class="room_id" disabled="true">
                @php($i = 0)
                @forelse($rooms as $val)
                <div class="room" style="border:1px #d6d6d6 solid;">
                    <div style="overflow:hidden" class="roomBox">
                            <div style="display:inline-block;">
                                <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}">
                            </div>
                            <div style="width:100%">
                            <h5>{{$val->room_name}}</h5>
                                <span>가격 {{number_format($val->room_price)}} / 1박</span>
                                <button type="button" class="roomInfoBtn"data-bs-toggle="modal" data-bs-target="#exampleModal{{$i++}}">객실 이용 안내 ></button>
                                <button type="button" class="reserveBtn" value="{{$val->id}}">예약하기</button>
                            </div>
                    </div>
                </div>
            </form>
            {{-- @php($i = 0)
            @forelse($rooms as $val)
            <div class="room" style="border:1px #d6d6d6 solid;">
                    <form action="{{route('users.payment')}}">
                <div style="overflow:hidden" class="roomBox">
                        <div style="display:inline-block;">
                            <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}">
                        </div>
                        <div style="width:100%">
                        <input type="hidden" name="room_id" value={{$val->id}}>
                        <input type="hidden" name="chk_in" id="chk_in" value="">
                        <input type="hidden" name="chk_out" id="chk_out" value="">
                        <input type="hidden" name="reserve_adult" id="reserve_adult" value="">
                        <input type="hidden" name="reserve_child" id="reserve_child" value="">
                        <h5>{{$val->room_name}}</h5>
                            <span>가격 {{number_format($val->room_price)}}</span>
                            <button type="button" class="roomInfoBtn"data-bs-toggle="modal" data-bs-target="#exampleModal{{$i++}}">객실 이용 안내 ></button>
                            <button type="submit" class="reserveBtn">예약하기</button>
                        </div>
                </div>
                    </form> --}}
            {{-- TODO 이미 예약 된 객실은 뜨면 안 됨--}}
            @empty
            <div>선택하신 날짜에 예약 가능한 객실이 없습니다. 날짜를 다시 선택해주세요</div>
            @endforelse
        </div>
        <div class="content">
            <div id="map"></div>
            <div class="addrBox">
                <i class="bi bi-geo-alt-fill"></i>
                <span class="addr">{{$hanok->hanok_addr}}</span>
                <button type="button" class="copy">주소복사</button>
            </div>
        </div>
        {{-- <div class="content">
            <strong>서비스</strong>
            <br>
            <div class="serviceCon">
                @foreach($amenities as $val)
                    <img src="{{asset($val->icon_img)}}" alt="{{$val->amenity_name}}" class="amenities">
                    <span>{{$val->amenity_name}}</span>
                @endforeach
            </div>
        </div> --}}
        {{-- <div class="content">
            <strong>숙소 안내</strong>
            <div>
                {!! nl2br($hanok->hanok_info) !!}
            </div>
            <br>
            <strong>환불정책</strong>
            <div>
                {!! nl2br($hanok->hanok_refund) !!}
            </div>
        </div> --}}
        <div class="content">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        기본정보
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            {{-- <div class="serviceCon"> --}}
                            
                            {{-- </div> --}}
                            <div>
                            <strong>숙소 안내</strong>
                            <div>
                                {!! nl2br($hanok->hanok_info) !!}
                            </div>
                            <strong>환불정책</strong>
                            <div>
                                {!! nl2br($hanok->hanok_refund) !!}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        편의 시설 및 서비스
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="amenityInfo">
                            @foreach($amenities as $val)
                                <div class="amenityCon">
                                    <img src="{{asset($val->icon_img)}}" alt="{{$val->amenity_name}}" class="amenities">
                                    <p>{{$val->amenity_name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content">
            <div>
                <p>이용 후기({{$rate->rev_cnt}})</p>
                <p>평균 별점</p>
                <img src="/img/icon/big_star.png" alt="별점" style="width:36px; height:36px">
                <span>{{number_format($rate->rate, 1)}}</span>
            </div>
            @forelse($reviews as $item)
                <div style="border:1px #d6d6d6 solid;padding:10px;">
                    <h5>{!! nl2br($item->rev_content) !!}</h5>
                    <img src="/img/icon/star.png" alt="별점" style="width:16px; height:16px">
                    <span>{!! nl2br($item->rate) !!}</span>
                    <span>{!! nl2br(substr($item->created_at, 0, 10)) !!}</span>
                </div>
            @empty
            <div>아직 리뷰가 작성되지 않았습니다.</div>
            @endforelse
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@php($j = 0)
@forelse($rooms as $item)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$j}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">객실 이용 안내</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    {{-- todo 객실 이미지 캐러셀 --}}
        <div class="modalCon">
            <div style="overflow:hidden; width:250px;" class="imgBox">
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
                {{-- todo 객실 이미지 캐러셀 --}}
            {{-- <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}" class="img"> --}}
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
@empty
    
@endforelse
{{-- {{var_dump(session('user_id'))}} --}}

<input type="hidden" name="longitude" id="longitude" value="{{$hanok->longitude}}">
<input type="hidden" name="latitude" id="latitude" value="{{$hanok->latitude}}">
<input type="hidden" name="user_id" id="user_id" value="{{session("user_id")}}">

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=c13a45bd5670fc2f9682582b81e72b29"></script>
<script src="{{asset('js/detail.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection