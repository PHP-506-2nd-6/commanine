{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminReserve.blade.php
 * 이력       : 0720 BYJ new
 * *********************************** */ --}}
@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminReserve.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
@section('contents')
    <div class="container row main-container ">
        @include('layout.adminsidebar')
        <div class="container col-9 content-box">
        <h2>예약관리</h2>
    <form action="{{route('admin.reservation.search')}}" method="get">
        {{-- <div class="search_form">
            <label for="chk_in">예약기간</label>
            <input name="chkIn" type="text" class="datepicker" id="datepicker" autocomplete="off" readonly>
            <label for="chk_out">~</label>
            <input name="chkOut" type="text" class="datepicker2" id="datepicker2" autocomplete="off" readonly>
        </div> --}}
        <select name="searchType" size="1" class="selectList" id="select_1">
            <option  value="id">예약번호</option>
            <option value="reserve_name" >이름</option>
            <option value="reserve_num" >전화번호</option>
        <input type="text" name="keyword" autocomplete="off">
        </select>
         {{-- <input type="text" name="reservations"> --}}
        {{-- <br>
        <select name="hanokType" size="1" class="selectList" id="select_1">
            <option  selected>전체</option>
            <option value="0" >예약완료</option>
            <option value="1" >예약대기</option>
        </select> --}}
        <button type="submit">검색</button>
    </form>
    <div class="searchUl">
            <div class="searchList">
                <table>
                    <thead>
                    <tr>
                        <th>예약번호</th>
                        <th>예약숙소/객실</th>
                        <th>예약자</th>
                        <th>휴대폰</th>
                        <th>예약일시</th>
                        <th>처리현황</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $val)
                    <tr>
                        <td>{{ $val->reserve_id }}</td>
                        <td>{{ $val->hanok_name }}/{{ $val->room_name }}</td>
                        <td>{{ $val->reserve_name }}</td>
                        <td>{{ $val->reserve_num }}</td>
                        <td>{{ $val->created_at }}</td>
                        <td>
                            @if($val->reserve_flg === '1')
                                <span>예약완료</span>
                            @else
                                <span>예약대기</span>
                            @endif
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
                {{ $reservations->withQueryString()->links('vendor.pagination.custom') }}
            </div>
    </div>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/adminreserve.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection