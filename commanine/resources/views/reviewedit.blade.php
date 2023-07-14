@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/reviewedit.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="reviewBox">
            <h2>리뷰 수정</h2>
            <div class="reserve_con reserve_wrap">
                <div class="review">
                    @include('layout.errors_validate')
                    <h4>{{$review->hanok_name}}</h4>
                    <div class="flexReviewEdit">
                        <div>
                            <i class="fa-solid fa-star star"></i>
                            <span>{{$review->rate}}</span>
                        </div>
                        <span class="rev_date">{{substr($review->created_at, 0, 10)}}</span>
                    </div>
                    <div class="alertSuc">{!! session()->has('success') ? session('success') : "" !!}</div>
                    <form action="{{route('users.review.edit.post', ['rev_id' => $review->rev_id])}}" method="post">
                        @csrf
                            <textarea name="rev_content" id="rev_content" spellcheck="false" cols="50" rows="12">{{$review->rev_content}}</textarea>
                        <div class="btnCon">
                            <button class="updateBtn" type="submit">수 정</button>
                            <button class="cancelBtn"type="button" onclick="location.href='{{route('users.information.review')}}'">취 소</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/da11601548.js" crossorigin="anonymous"></script>
@endsection