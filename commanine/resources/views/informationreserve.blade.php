@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/informationreserve.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> --}}
</head>
@section('contents')
<div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="reserve_box">
            <h2>예약 내역</h2>
            <div class="reserve_cont">
                @forelse($reserve as $data)
                <div class="reserve_content">
                    <div class="con reserve_img">
                        <img src="{{asset($data->hanok_img1)}}" alt="#">
                    </div>
                    <div class="con">
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

                    {{-- @if($val->room_id === 0) --}}

                         <a id="writeButton" href="{{route('users.review')}}">리뷰 작성하기</a>

                    {{-- <button id="writeButton" onclick="checkDataAndRedirect()">작성하기</button> --}}
                    {{-- <button onclick="location.href='{{ route('check-data-and-redirect') }}'">작성하기</button> --}}
                    {{-- @endif --}}
                </div>
            </div>
            @empty
                <span>예약한 숙소가 없습니다.</span> 
            @endforelse
        </div>
    </div>


<script src="{{asset('js/review.js')}}"></script>
@endsection