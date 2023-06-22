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
        {{-- <div class="rating"> --}}
            <input type="text" class="rating__result" name="rate" id="rate">
            <i class="rating__star far fa-star"></i>
            <i class="rating__star far fa-star"></i>
            <i class="rating__star far fa-star"></i>
            <i class="rating__star far fa-star"></i>
            <i class="rating__star far fa-star"></i>
        {{-- </div> --}}
        <label for="rev_content">내용 : </label>
        <textarea name="rev_content" id="rev_content"></textarea>
        <br>
        <button type="submit">작성</button>
    </form>


<script src="{{asset('js/review.js')}}"></script>
@endsection