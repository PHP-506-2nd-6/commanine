@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/informationreserve.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> --}}
</head>
@section('contents')
<div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div>
        <div class="reserve_box">
            <h2>예약 내역</h2>
            <div class="reserve_cont">
                @forelse($reserve as $data)
                <div class="reserve_content">
                    <div class="con reserve_img">
                        <img src="{{asset($data->hanok_img1)}}" alt="#">
                    </div>
                    <div class="con">
                        <div class="contit">숙소명
                        <p>{{$data->hanok_name}}</p></div>
                        <div class="contit">객실명<p>
                        {{$data->room_name}}</p></div>
                        <div class="contit">가격
                        <p>{{$data->room_price}}</p></div>
                        <div class="contit">예약 날짜
                        <p>{{$data->chk_in}} ~ {{$data->chk_out}}</p></div>
                        <div class="contit">인원
                        <p>{{$data->reserve_adult}}</p></div>
                    </div>

                    {{-- @if($val->room_id === 0) --}}

                        <form action="{{route('users.review')}}" method="get">
                            <input type="hidden" name="hanok_id" value="{{$data->id}}">
                            <button type="submit">리뷰 작성하기</button>
                        </form>
                        {{-- <a id="writeButton" href="{{route('users.review')}}">리뷰 작성하기</a> --}}

                    {{-- <button id="writeButton" onclick="checkDataAndRedirect()">작성하기</button> --}}
                    {{-- <button onclick="location.href='{{ route('check-data-and-redirect') }}'">작성하기</button> --}}
                    {{-- @endif --}}
                </div>
            </div>
            @empty
                <span>예약한 숙소가 없습니다.</span> 
            @endforelse
            <div class="d-flex justify-content-center"> 
                {{$reserve->onEachSide(3)->withQueryString()->links()}}
            </div>
            </div>
        </div>
    </div>


<script src="{{asset('js/review.js')}}"></script>
@endsection