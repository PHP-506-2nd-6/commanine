{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : reviewinsert.blade.php
 * 이력       : 0615 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/review.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
@section('contents')
<div>리뷰 작성</div>
    @include('layout.errors_validate')
    <form action="{{route('users.review.post')}}" method="post">
        @csrf
            {{-- <input type="text" name="rate" id="rate"> --}}
            {{-- <p class="rating__result">{{ $rating }}</p> --}}
            {{-- <span type="text" class="rating__result" name="rate" id="rate" data-value="1"></span> --}}
            {{-- <input class="rating__result"  name="rate" id="rate"> --}}

            {{-- <span type="text" class="rating__result" name="rate" id="ratingInput" value="{{ old('rating') }}"></span> --}}
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

        <label for="rev_content">내용 : </label>
        <textarea name="rev_content" id="rev_content"></textarea>
        <br>
        <button type="submit">작성</button>
    </form>


<script src="{{asset('js/review.js')}}"></script>
@endsection