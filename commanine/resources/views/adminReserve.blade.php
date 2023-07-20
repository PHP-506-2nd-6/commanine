{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminReserve.blade.php
 * 이력       : 0720 BYJ new
 * *********************************** */ --}}
<head>
    <link rel="stylesheet" href="{{asset('css/adminReserve.css')}}">
</head>
@extends('layout.adminlayout')
@section('contents')
    {{-- <div class="container row"> --}}
        @include('layout.adminsidebar')
        <h2>예약정보</h2>
    {{-- <form action="{{route('admin.hanoks.search')}}" method="get">
        <input type="text" placeholder="숙소명 / 주소 입력" name="hanoks">
        <button type="submit">검색</button>
    </form> --}}
    <div class="searchUl">
            <div class="searchList">
                <table>
                    <thead>
                    <tr>
                        {{-- <th>이미지</th> --}}
                        {{-- <th>예약 상태</th> --}}
                        <th>예약 날짜</th>
                        <th>숙소 이름</th>
                        <th>객실 이름</th>
                        <th>가격</th>
                        <th>인원</th>
                        {{-- <th>인원(아동)</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $val)
                    <tr>
                        {{-- <td><img class="imgBox" src="{{asset($val->hanok_img1)}}" ></td> --}}
                        {{-- <td>
                            @if($val->reserve_flg === '1')
                                <span>예약완료</span>
                            @else
                                <span>결제대기</span>
                            @endif
                        </td> --}}
                        <td>{{substr($val->chk_in,0,10)}} ~ {{substr($val->chk_out,0,10)}}</td>
                        <td>{{ $val->hanok_name }}</td>
                        <td>{{ $val->room_name }}</td>
                        <td>{{ $val->room_price }}</td>
                        <td>{{ $val->reserve_adult }} 명</td>
                        {{-- <td>{{ $val->reserve_kid }} 명</td> --}}
            </div>
        </div>
        @empty
            <tr class="searchList noSearch" >검색된 결과가 없습니다.</tr>
        @endforelse
                    </tr>
                    </tbody>
                </table>
    

    {{-- <div class="d-flex justify-content-center" > 
        {{ $hanoks->withQueryString()->links('vendor.pagination.custom') }}
    </div> --}}

    {{-- </div> --}}
@endsection