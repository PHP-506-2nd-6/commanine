{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminReview.blade.php
 * 이력       : 0721 BYJ new
 * *********************************** */ --}}
@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/adminReserve.css')}}"> --}}
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
        <button type="submit">검색</button>
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
                        <td>{{ $val->rev_content }}</td>
                        <td>{{ $val->rate }}</td>
                        <td>{{ $val->hanok_name }}</td>
                        <td>{{ $val->created_at }}</td>
                        <td>{{ $val->updated_at }}</td>
                        <td>{{ $val->deleted_at }}</td>
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