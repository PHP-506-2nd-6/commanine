 {{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : informationdibs.blade.blade.php
 * 이력       : 0717 KMH new
 * *********************************** */  --}}


@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/informationdibs.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="dibs_box">
            <h2>찜 목록</h2>
            <div class="dibs_cont"> 
            @forelse($data as $val)
                <div class="dibs_content">
                    <div class="con reserve_img">
                        <img src="{{asset($val->hanok_img1)}}" alt="hanok_img" class="img">
                    </div>
                    <div class="con">
                        <div class="dibs_item">숙소명 : <span>{{$val->hanok_name}}</span></div>
                        <div class="dibs_item" >주소 : <span>{{$val->hanok_addr}}</span></div>
                        <div class="dibs_item" ><img src="{{asset('img/icon/star.png')}}" alt="star" style="width:16px; height:16px;"><span>{{isset($val->rate) ? substr($val->rate,0,3) : "0"}} ({{$val->cnt}})</span></div>
                        <form action="{{route('hanoks.detail',$val->id)}}" method="get" class="dibs_item">
                            <input type="hidden" name="hanok_id" value="{{$val->id}}">
                            <button class="review_btn" type="submit">숙소 보러가기</button>
                        </form>
                    </div>
                </div>
            @empty
                <span>찜한 숙소가 없습니다.</span> 
            @endforelse
            </div>
            <div class="d-flex justify-content-center" > 
                {{-- {{$searches->onEachSide(5)->withQueryString()->links()}} --}}
                {{ $data->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection


