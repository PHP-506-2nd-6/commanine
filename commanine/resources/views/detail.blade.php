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
            <div style="display:inline-block;width:130px;height:30px;text-align:center;border:1px #d6d6d6 solid;border-radius:2px">06-13 ~ 06-14</div>{{-- TODO 이거 누르면 아래 div활성화 --}}
            <div style="display:inline-block;width:130px;height:30px;text-align:center;border:1px #d6d6d6 solid;border-radius:2px">투숙객 2명</div>
            <div class="datePicker">
                <input type="date" name="date" id="date"> {{-- TODO 캘린더로 최대 7박까지 선택 가능하게 --}}
                <button>적용</button>
            </div>
            @forelse($rooms as $val)
            <div class="room" style="border:1px #d6d6d6 solid;">
                <div>
                    <div style="overflow:hidden" class="roomBox">
                        <div style="display:inline-block;">
                            <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}">
                        </div>
                        <div style="width:100%">
                        <h5>{{$val->room_name}}</h5>
                            <span>가격 {{number_format($val->room_price)}}</span>
                            <button type="button" style="background-color:#ccc" class="roomInfoBtn">객실 이용 안내 ></button>{{--TODO 이거 누르면 모달창으로 뜨기--}}
                            <button type="button" class="reserveBtn">예약하기</button>{{--TODO 이거 누르면 모달창으로 뜨기--}}
                            {{-- <button type="button" style="background-color:#ccc" class="roomInfoBtn"data-bs-toggle="modal" data-bs-target="#exampleModal{{$i++}}">객실 이용 안내 ></button>TODO 이거 누르면 모달창으로 뜨기 --}}
                        </div>
                    </div>
                </div>
            {{-- TODO 예약 가능한 객실 없으면 '선택하신 날짜에 예약가능한 객실이 없습니다. 날짜를 다시 선택해주세요' 출력 이미 예약 된 객실은 뜨면 안 됨--}}
            </div>
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
@forelse($rooms as $val)
<div class="roomModal"style="border:1px black solid;">{{-- TODO 객실 이용 안내 모달 --}}
    <div>
        <div style="overflow:hidden" class="imgBox">
            캐러셀
            {{-- <div> --}}
                <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}" class="img">
            {{-- </div> --}}
        </div>
    </div>
    <div>
        <h3>{{$val->room_name}}</h3>
        <div>체크인 {{$val->chk_in}} 체크아웃 {{$val->chk_out}}</div>
        <div>최소 {{$val->room_min}}인 / 최대 {{$val->room_max}}인</div>
    </div>
    <div>
        <div>{!! nl2br($val->room_content) !!}</div>
        <div>{!! nl2br($val->room_detail) !!}</div>
        <div>{!! nl2br($val->room_facility) !!}</div>
    </div>
</div>

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal{{$i++}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}" class="img">
    <div>
        <h3>{{$val->room_name}}</h3>
        <div>체크인 {{$val->chk_in}} 체크아웃 {{ $val->chk_out}}</div>
        <div>최소 {{$val->room_min}}인 / 최대 {{$val->room_max}}인</div>
    </div>
    <div>
        <div>{!! nl2br($val->room_content) !!}</div>
        <div>{!! nl2br($val->room_detail) !!}</div>
        <div>{!! nl2br($val->room_facility) !!}</div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div> --}}
@empty
    
@endforelse
{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}
<form>
    <input type="hidden" name="longitude" id="longitude" value="{{$hanok->longitude}}">
    <input type="hidden" name="latitude" id="latitude" value="{{$hanok->latitude}}">
</form>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=c13a45bd5670fc2f9682582b81e72b29"></script>
<script src="{{asset('js/detail.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection