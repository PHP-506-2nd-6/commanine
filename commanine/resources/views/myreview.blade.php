@extends('layout.layout')
<head>
    {{-- <link rel="stylesheet" href="{{asset('css/informationinfo.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/myreview.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
</head>
@section('contents')
    <div class="wrap wrapGrid">
        @include('layout.sidebar')
        <div class="myreview_wrap">
        <h2>내 리뷰</h2>
            <div class="reserve_con reserve_wrap">
                @forelse($review as $val)
                    <div class="review">
                        <h4>{{$val->hanok_name}}</h4>
                        <img src="/img/icon/star.png" alt="별점" style="width:16px; height:16px">
                        <span>{{$val->rate}}</span>
                        <p>{!! nl2br($val->rev_content)!!}</p>
                        <p>{{substr($val->created_at, 0, 10)}}</p>
                        <button type="button">수정</button>
                        <form action="{{route('users.information.review.delete', ['id' => $val->rev_id])}}" method="POST">
                            @csrf
                            <button type="submit">삭제</button>
                        </form>
                    </div>
                @empty
                    <span>작성한 리뷰가 없습니다.</span>
                @endforelse
            </div>
        {{ $review->links() }}
        </div>
    </div>
@endsection