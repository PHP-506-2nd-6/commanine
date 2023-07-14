@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/informationreserve.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> --}}
</head>
@section('contents')
<div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="reserve_box" style="margin-left: 150px;">
            <h2>예약 내역</h2>
            <div class="reserve_cont">
                @forelse($reserve as $data)
                <div class="reserve_content">
                    <div class="con reserve_img">
                        <img src="{{asset($data->hanok_img1)}}" alt="#">
                        <form action="{{route('users.review')}}" method="get">
                            <input type="hidden" name="hanok_id" value="{{$data->id}}">
                            <button class="review_btn" type="submit">리뷰 작성하기</button>
                        </form>
                    </div>
                    <div class="con">
                        <div class="contit">숙소명
                        <p>{{$data->hanok_name}}</p></div>
                        <div class="contit">객실명<p>
                        {{$data->room_name}}</p></div>
                        <div class="contit">가격
                        <p>{{$data->room_price}}</p></div>
                        <div class="contit">예약 날짜
                        <p>{{substr($data->chk_in,0,10)}} ~ {{substr($data->chk_out,0,10)}}</p></div>
                        <div class="contit">인원
                        <p>{{$data->reserve_adult}} 명</p></div>

                        <div class="reserve_flg">
                            <span>예약상태 : </span>
                            @if($data->reserve_flg === '1')
                                <span>예약완료</span>
                            @else
                                <span>결제대기</span>
                            @endif
                        </div>
                        
                    </div>

                    {{-- @if($val->room_id === 0) --}}

                        {{-- <form action="{{route('users.review')}}" method="get">
                            <input type="hidden" name="hanok_id" value="{{$data->id}}">
                            <button class="review_btn" type="submit">리뷰 작성하기</button>
                        </form> --}}
                        {{-- <a id="writeButton" href="{{route('users.review')}}">리뷰 작성하기</a> --}}

                    {{-- <button id="writeButton" onclick="checkDataAndRedirect()">작성하기</button> --}}
                    {{-- <button onclick="location.href='{{ route('check-data-and-redirect') }}'">작성하기</button> --}}
                    {{-- @endif --}}
                </div>
            @empty
                <span>예약한 숙소가 없습니다.</span> 
            @endforelse
            </div>
            <div class="d-flex justify-content-center" style="width:750px"> 
                {{-- {{$reserve->onEachSide(1)->withQueryString()->links()}} --}}
                {{ $reserve->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>


<script src="{{asset('js/review.js')}}"></script>
@endsection