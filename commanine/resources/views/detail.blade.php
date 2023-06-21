@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>
@section('contents')
    <div class="hanokInfo">
        <div style="overflow:hidden;" class="imgBox">
            {{-- <div> --}}
                <img src="{{asset($hanok->hanok_img1)}}" alt="{{$hanok->hanok_name}}" class="img">
            {{-- </div> --}}
        </div>
    <div style="border:1px black solid;">
        <h5>{{$hanok->hanok_name}}</h5>
        <span>평균별점</span>
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
        <button type="button" class="tabBtn">서비스</button>
        <button type="button" class="tabBtn">안내/정책</button>
        <button type="button" class="tabBtn">후기</button>
        <div class="line"></div>
    </div>
    <div class="conBox">
        <div class="content active">
            {{-- <div style="display:inline-block;width:130px;height:30px;text-align:center;border:1px #d6d6d6 solid;border-radius:2px">06-13 ~ 06-14</div>
            <div style="display:inline-block;width:130px;height:30px;text-align:center;border:1px #d6d6d6 solid;border-radius:2px">투숙객 2명</div>
            <div class="datePicker">
                <input type="date" name="date" id="date">
                <button>적용</button>
            </div> --}}
            <form id="frm" method="get" action="" >
                <div class="search_form">
                    <div class="search_form2">
                        <label for="chk_in">체크인</label>
                        <input type="date" id="chkIn" name="chk_in" required>
                        <label for="chk_out">체크아웃</label>
                        <input type="date" id="chkOut" name="chk_out">
                        <span>성인</span>
                        <input type="number" min="1" max="16" value="2" id="adult" name="reserve_adult">
                        <span>아동</span>
                        <input type="number" min="0" max="16" value="0" id="child" name="reserve_child">
                    </div>
                    <button type="submit" class="searchBtn">검색</button>
                </div>
                @php($i = 0)
                @forelse($rooms as $val)
                <div class="room" style="border:1px #d6d6d6 solid;">
                    <div style="overflow:hidden" class="roomBox">
                            <div style="display:inline-block;">
                                <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}">
                            </div>
                            <div style="width:100%">
                            <input type="hidden" name="room_id" id="room_id" value="{{$val->id}}" disabled>
                            <h5>{{$val->id}}</h5>
                            <h5>{{$val->room_name}}</h5>
                                <span>가격 {{number_format($val->room_price)}} / 1박</span>
                                <button type="button" class="roomInfoBtn"data-bs-toggle="modal" data-bs-target="#exampleModal{{$i++}}">객실 이용 안내 ></button>
                                <button type="button" class="reserveBtn" onclick="return reserve()">예약하기</button>
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
            <div id="map"></div> {{-- TODO 카카오맵 api 가져오기 --}}
            <div class="addrBox">
                <i class="bi bi-geo-alt-fill"></i>
                <span class="addr">{{$hanok->hanok_addr}}</span>
                <button type="button" class="copy">주소복사</button>
            </div>
        </div>
        <div class="content">서비스
            <div>어메니티 아이콘</div>
        </div>
        <div class="content">
            <strong>숙소 안내</strong>
            <div>
                {!! nl2br($hanok->hanok_info) !!}
            </div>
            <br>
            <strong>환불정책</strong>
            <div>
            {!! nl2br($hanok->hanok_refund) !!}
            </div>
        </div>
        <div class="content">
            @forelse($reviews as $val)
                <div>평균 별점이랑 리뷰 갯수 출력</div>
                <div>
                    {!! nl2br($hanok->hanok_refund) !!}
                </div>
            @empty
            <div>아직 리뷰가 작성되지 않았습니다.</div>
            @endforelse
        </div>
    </div>
</div>
@php($j = 0)
@forelse($rooms as $val)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$j++}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">객실 이용 안내</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    {{-- todo 객실 이미지 캐러셀 --}}
        {{-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div> --}}
    {{-- todo 객실 이미지 캐러셀 --}}
        <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}" class="img">
        <div>
            <h3>{{$val->room_name}}</h3>
            <div>체크인 {{$val->chk_in}} 체크아웃 {{ $val->chk_out}}</div>
            <div>기준 {{$val->room_min}}인 / 최대 {{$val->room_max}}인</div>
        </div>
        <hr>
            <div>
                <strong>기본 정보</strong>
                <div>{!! nl2br($val->room_content) !!}</div>
                <div>{!! nl2br($val->room_detail) !!}</div>
            <hr>
                <strong>편의 시설</strong>
                <div>{!! nl2br($val->room_facility) !!}</div>
            </div>
        </div>
    </div>
</div>
</div>
@empty
    
@endforelse

<form>
    <input type="hidden" name="longitude" id="longitude" value="{{$hanok->longitude}}">
    <input type="hidden" name="latitude" id="latitude" value="{{$hanok->latitude}}">
</form>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=c13a45bd5670fc2f9682582b81e72b29"></script>
<script src="{{asset('js/detail.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection