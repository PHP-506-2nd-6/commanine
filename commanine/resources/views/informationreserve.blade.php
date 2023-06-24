@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/informationreserve.css')}}">
</head>
@section('contents')
    <div class="wrap">
        <div>
            <ul>
                <li><a href="{{route('users.information.reserve')}}">예약 내역</a></li>
                {{-- <li><a href="{{route('users.information.dibs')}}">찜 목록</a></li> --}}
                <li><a href="{{route('users.information.info')}}">회원 정보</a></li>
                {{-- <li><a href="{{route('users.information.review')}}">내 리뷰</a></li> --}}
            </ul>
        </div>
        <div class="reserve_wrap">
            <h1>예약 내역</h1>
            <div class="reserve_con">
                @forelse($reserve as $data)
                <div class="con reserve_img">
                    <img src="{{asset($data->hanok_img1)}}" alt="#">
                </div>
                <div class="con">
                    {{-- <div>아이디</div>
                    <div><p>{{$data->user_id}}</p></div> --}}
                    <div>숙소명</div>
                    <div><p>{{$data->hanok_name}}</p></div>
                    <div>객실명</div>
                    <div><p>{{$data->room_name}}</p></div>
                    <div>가격</div>
                    <div>{{$data->room_price}}</div>
                    <div>예약 날짜</div>
                    <div><p>{{$data->chk_in}} ~ {{$data->chk_out}}</p></div>
                    <div>인원</div>
                    <div><p>{{$data->reserve_adult}}</p></div>
                </div>

                <a href="{{route('users.review')}}">리뷰 작성하기</a>
        @empty
            <span>예약한 숙소가 없습니다.</span> 
        @endforelse
            </div>
        </div>
    </div>




@endsection