@extends('layout.layout')

@section('contents')
    <h1>내 리뷰</h1>
    <div>
        @forelse($variable as $val)
            <div>숙소명</div>
            <div>객실명</div>
            <div>별점</div>
            <div>코멘트</div>
            <div>날짜</div>
            <button>수정</button> {{-- 리뷰 수정 페이지로 이동 --}}
            <button>삭제</button> {{-- 리뷰 삭제 페이지로 이동 혹은 confirm으로 체크 --}}
        @empty
            <span>작성한 리뷰가 없습니다.</span> {{-- 작성한 리뷰가 없을 때 메세지 --}}
        @endforelse
    </div>
@endsection