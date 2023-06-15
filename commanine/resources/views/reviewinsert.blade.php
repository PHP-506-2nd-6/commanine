{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : reviewinsert.blade.php
 * 이력       : 0615 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')

@section('contents')
<div>리뷰 수정</div>
    @include('layout.errors_validate')
    <form action="{{route('users.review.post')}}" method="post">
        @csrf
        <label for="comment">내용 : </label>
        <textarea name="comment" id="comment"></textarea>
        <br>
        <button type="submit">작성</button>
        <button type="button">수정</button>
    </form>
@endsection