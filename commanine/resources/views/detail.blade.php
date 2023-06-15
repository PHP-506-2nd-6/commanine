@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
</head>
@section('contents')
    <div style="border:1px black solid;">
        <div style="overflow:hidden;">
            <div>
                <img src="{{asset($hanok->hanok_img1)}}" alt="{{$hanok->hanok_name}}">
            </div>
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
        <div style="border:1px black solid;"><span>{{$hanok->hanok_comment}}</span></div>
    </div>
</div>
<div class="detailTap">
    <button type="button" class="roomBtn">객실선택</button> {{-- TODO 탭 메뉴 기본적으로 객실선택 --}}
    <button type="button" class="addrBtn">위치</button>
    <button type="button" class="serviceBtn">서비스</button>
    <button type="button" class="policyBtn">정책</button>
    <button type="button" class="reviewBtn">후기</button>
</div>
<div style="border:1px black solid;">
    <div class="rooms">
        <div style="display:inline-block;width:130px;height:30px;text-align:center;border:1px #d6d6d6 solid;border-radius:2px">06-13 ~ 06-14</div>{{-- TODO 이거 누르면 아래 div활성화 --}}
        <div class="datePicker">
            <input type="date" name="date" id="date"> {{-- TODO 캘린더로 최대 7박까지 선택 가능하게 --}}
            <button>적용</button>
        </div>
        @php($i=0)
        @forelse($rooms as $val)
        <div class="room{{$i++}}" style="border:1px #d6d6d6 solid;">
            <div>
                <div style="overflow:hidden">
                    캐러셀
                    <h5>{{$val->room_name}}</h5>
                    <div>
                        <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}">
                        객실 사진 최대 5장까지
                    </div>
                    <div>
                        <h5>가격 {{number_format($val->room_price)}}</h5>
                    </div>
                </div>
            </div>
        {{-- TODO 예약 가능한 객실 없으면 '선택하신 날짜에 예약가능한 객실이 없습니다. 날짜를 다시 선택해주세요' 출력 이미 예약 된 객실은 뜨면 안 됨--}}
            <button type="button" class="roomInfoBtn">객실 이용 안내 ></button>{{-- TODO 이거 누르면 모달창으로 뜨기 --}}
        </div>
            
        @empty
            
        @endforelse
    </div>
    <div class="addr" style="background-color:#96fdff;">
        <div>카카오맵</div> {{-- TODO 카카오맵 api 가져오기 --}}
        <div>{{$hanok->hanok_addr}}
            <button>주소복사</button>
        </div>
    </div>
    <div class="service" style="background-color:#96bdff;">서비스
        <div>어메니티 아이콘</div>
    </div>
    <div class="policy" style="background-color:#b896ff;">{{$hanok->hanok_refund}}</div>
    <div class="review" style="background-color:#ffcb96;">리뷰
        <div>평균 별점이랑 리뷰 갯수 출력</div>
        <div>forelse 사용해서 리뷰 없으면 '아직 리뷰가 작성되지 않았습니다.' 출력</div>
    </div>
</div>
@php($i=0)
@forelse($rooms as $val)
<div class="roomModal{{$i++}}"style="border:1px black solid;">{{-- TODO 객실 이용 안내 모달 --}}
    <div>
        <div style="overflow:hidden">
            캐러셀
            <div>
                <img src="{{asset($val->room_img1)}}" alt="{{$val->room_name}}">
            </div>
        </div>
    </div>
    <div>
        <h3>{{$val->room_name}}</h3>
        <div>체크인 {{$val->chk_in}} 체크아웃 {{ $val->chk_out}}</div>
        <div>최소 {{$val->room_min}}인 / 최대 {{$val->room_max}}인</div>
    </div>
    <div>
        <div>{{$val->room_content}}</div>
        <div>{{$val->room_detail}}</div>
        <div>{{$val->room_facility}}</div>
    </div>
</div>
<script src="{{asset('js/detail.js')}}"></script>
@empty
    
@endforelse
@endsection