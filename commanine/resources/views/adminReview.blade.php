{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminReview.blade.php
 * 이력       : 0721 BYJ new
 * *********************************** */ --}}
@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/adminreview.css')}}"> --}}
</head>
@section('contents')
    <div class="container row main-container ">
        @include('layout.adminsidebar')
        <div class="container col-9 content-box">
        <h2>리뷰관리</h2>
    <form action="{{route('admin.review.search')}}" method="get">
        {{-- <select name="revsearchType" size="1" class="selectList" id="select_1">
            <option  value="user_name">회원이름</option>
            <option value="rev_content" >리뷰 내용</option>
            <input type="text" name="revkeyword">
        </select> --}}
            <input type="text" placeholder="회원이름/리뷰 내용" name="revkeyword" class="input">
        <button type="submit" class="btn btn-dark">검색</button>
    </form>
    <div class="searchUl">
            <div class="searchList">
                <table>
                    <thead>
                    <tr>
                        <th>회원 이름</th>
                        <th>리뷰 내용</th>
                        <th>별점</th>
                        <th>숙소 이름</th>
                        <th>작성일자</th>
                        <th>수정일자</th>
                        <th>삭제일자</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($review as $val)
                    <tr>
                        <td>{{ $val->user_name }}</td>
                        <td><a href="{{route('hanoks.detail', ['id' => $val->hanok_id])}}">{{ $val->rev_content }}</a></td>
                        <td>{{ $val->rate }}</td>
                        <td>{{ $val->hanok_name }}</td>
                        <td>{{ $val->created_at }}</td>
                        <td>{{ $val->updated_at }}</td>
                        <td>{{ $val->deleted_at }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.review.update', ['review_id' => $val->rev_id]) }}">
                                @csrf
                                @method('PUT')
                                @if( $val->rev_flg === '0' )
                                    <button type="submit">숨기기</button>
                                @else
                                    <button type="submit">보이기</button>
                                @endif
                            </form>
                        </td>
                        {{-- <td><a href="{{route('admin.review.update', ['review_id' => $val->rev_id])}}"><button type="button">수정</button></a></td> --}}
                        <td>
                            <form method="POST" action="{{ route('admin.review.delete', ['review_id' => $val->rev_id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">삭제</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>검색된 결과가 없습니다.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center" > 
                {{ $review->withQueryString()->links('vendor.pagination.custom') }}
            </div>
    </div>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/adminreserve.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection