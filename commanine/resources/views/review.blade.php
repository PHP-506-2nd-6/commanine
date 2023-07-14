@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/myreview.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="myreview_wrap">
        <h2>내 리뷰</h2>
            <div class="reserve_con reserve_wrap">
                @forelse($review as $val)
                    <div class="review">
                        <a href="{{route('hanoks.detail', ['id' => $val->hanok_id])}}">
                            <h4>{{$val->hanok_name}}</h4>
                        </a>
                        <i class="fa-solid fa-star star"></i>
                        <span>{{$val->rate}}</span>
                        <div>{!! nl2br($val->rev_content)!!}</div>
                        <div>{{substr($val->created_at, 0, 10)}}</div>
                        <div class="btnCon">
                            <button type="button" class="editBtn" onclick="location.href='{{route('users.review.edit', ['rev_id' => $val->rev_id])}}'">수정</button>
                            <form class="frm" action="{{route('users.information.review.delete', ['rev_id' => $val->rev_id])}}" method="POST" onsubmit="return confirm('리뷰를 정말로 삭제하시겠습니까?');">
                                @csrf
                                <button type="submit" class="delBtn">삭제</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <span>작성한 리뷰가 없습니다.</span>
                @endforelse
            </div>
            <div class="d-flex justify-content-center pageCon">
                {{ $review->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/da11601548.js" crossorigin="anonymous"></script>
@endsection