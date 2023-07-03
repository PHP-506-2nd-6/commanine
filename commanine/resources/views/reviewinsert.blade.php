{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : reviewinsert.blade.php
 * 이력       : 0615 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/review.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
@section('contents')
    <div class="wrap wrapGrid">
    @include('layout.sidebar')
    <div class="reviewBox">
        <h2>리뷰 작성</h2>
        <div class="review_wrap">
        @include('layout.errors_validate')
        <div class="alertSuc">{!! session()->has('success') ? session('success') : "" !!}</div>
            <form action="{{route('users.review.post')}}" method="post">
                @csrf
                <input type="hidden" id="hanok_id" name="hanok_id" value="{{$data}}">
                <span>별점</span>
                <input type="hidden" id="ratingInput" class="rating__result" name="rate" value="{{ old('rating') }}">
                <div class="rating">
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                {{-- <fieldset>
                    <span class="text-bold">별점을 선택해주세요</span>
                    <input type="radio" name="rate" value="1" id="rate1"><label
                        for="rate1">★</label>
                    <input type="radio" name="rate" value="2" id="rate2"><label
                        for="rate2">★★</label>
                    <input type="radio" name="rate" value="3" id="rate3"><label
                        for="rate3">★★★</label>
                    <input type="radio" name="rate" value="4" id="rate4"><label
                        for="rate4">★★★★</label>
                    <input type="radio" name="rate" value="5" id="rate5"><label
                        for="rate5">★★★★★</label>
                </fieldset> --}}
                </div>
                <br>
                <div class="con_box">
                    <label for="rev_content">리뷰 작성하기</label>
                    <br>
                    <textarea name="rev_content" id="rev_content" spellcheck="false" cols="50" rows="12"></textarea>
                    
                </div>
                <br>
                <div class="btnCon">
                    <button class="updateBtn" type="submit">작성</button>
                    <button class="cancelBtn" type="button" onclick="location.href='{{route('users.information.reserve')}}'">취 소</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('js/review.js')}}"></script>
@endsection