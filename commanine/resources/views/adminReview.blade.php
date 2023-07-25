{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminReview.blade.php
 * 이력       : 0721 BYJ new
 * *********************************** */ --}}
@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminReview.css')}}">
</head>
@section('contents')
    <div class="container row main-container" style="max-width:2000px">
        @include('layout.adminsidebar')
        <div class="container col-9 content-box">
        <h2>리뷰관리</h2>
    <form class="form" action="{{route('admin.review.search')}}" method="get">
        <select name="revsearchType" size="1" class="selectList" id="select_1">
            <option  value="user_name" @if(request('revsearchType') === 'user_name') selected @endif>회원이름</option>
            <option value="rev_content" @if(request('revsearchType') === 'rev_content') selected @endif>리뷰 내용</option>
        </select>
            <input class="input" type="text" name="revkeyword" class="input" value="{{ request('revkeyword') }}">
        <button type="submit" class="btn btn-dark">검색</button>
    </form>
    <div class="searchUl">
            <div class="searchList">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">회원 이름</th>
                        <th scope="col" style="width: 400px;">리뷰 내용</th>
                        <th scope="col" style="width: 60px;">별점</th>
                        <th scope="col">숙소 이름</th>
                        <th scope="col">작성일자</th>
                        <th scope="col">수정일자</th>
                        {{-- <th scope="col">삭제일자</th> --}}
                        <th scope="col">리뷰관리</th>
                        <th scope="col">삭제관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($review as $val)
                    <tr>
                        <td class="td_chk">{{ $val->user_name }}</td>
                        <td class="td_chk"><a href="{{route('hanoks.detail', ['id' => $val->hanok_id])}}" target="_blank">{{ $val->rev_content }}</a></td>
                        {{-- <td class="td_chk"><a href="{{ route('hanoks.detail', ['id' => $val->hanok_id]) }}">{{ $val->rev_content }}</a></td> --}}
                        <td class="td_chk">{{ $val->rate }}</td>
                        <td class="td_chk">{{ $val->hanok_name }}</td>
                        <td class="td_chk">{{ $val->created_at }}</td>
                        <td class="td_chk">{{ $val->updated_at }}</td>
                        {{-- <td class="td_chk">{{ $val->deleted_at }}</td> --}}
                        <td class="td_chk">
                            <form class="frm" method="POST" action="{{ route('admin.review.update', ['review_id' => $val->rev_id]) }}">
                                @csrf
                                @method('PUT')
                                @if( $val->rev_flg === '0' )
                                    <button type="submit" class="btn btn-outline-primary">숨기기</button>
                                @else
                                    <button type="submit" class="btn btn-primary">보이기</button>
                                @endif
                            </form>
                        </td>
                        {{-- <td><a href="{{route('admin.review.update', ['review_id' => $val->rev_id])}}"><button type="button">수정</button></a></td> --}}
                        <td>
                            <form class="frm" method="POST" action="{{ route('admin.review.delete', ['review_id' => $val->rev_id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">삭제</button>
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