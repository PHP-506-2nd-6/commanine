@extends('layout.layout')
<head>
    {{-- <link rel="stylesheet" href="{{asset('css/informationinfo.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="dibsBox">
            <h2>찜 목록</h2>
            <div>
                <img src="{{$data->room_img1}}" alt="">
                <div>숙소명</div>
                <div>{{$data->hanok_name}}</div>
            </div>
        </div>
    </div>




@endsection


