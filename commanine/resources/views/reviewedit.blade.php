@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/reviewedit.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
@section('contents')
    <div class="wrap wrapGrid">
    @include('layout.sidebar')
    <div class="reviewBox">
        <h2>리뷰 수정</h2>
        <div class="review_wrap">
        @include('layout.errors_validate')
        <div class="alertSuc">{!! session()->has('success') ? session('success') : "" !!}</div>
            <form action="{{route('users.review.edit.post', ['rev_id' => $review->rev_id])}}" method="post">
                @csrf
                {{-- <input type="hidden" id="rev_id" name="rev_id" value="{{$review->rev_id}}"> --}}
                <br>
                <div class="con_box">
                    <textarea name="rev_content" id="rev_content" spellcheck="false" cols="50" rows="12">{{$review->rev_content}}</textarea>
                </div>
                <br>
                <button class="updateBtn" type="submit">수정</button>
                <button class="cancelBtn"type="button" onclick="location.href='{{route('users.information.review')}}'">취소</button>
            </form>
        </div>
    </div>
</div>
@endsection