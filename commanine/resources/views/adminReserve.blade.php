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
    <div class="container row main-container" style="max-width:2000px">
        @include('layout.adminsidebar')
        <div class="container col-9 content-box">
        <h2>예약관리</h2>
        <div class="form_wrap">
            <form class="form" action="{{route('admin.reservation.search')}}" method="get">
                <div class="search_form">
                    <label for="chk_in">예약기간</label>
                    <input name="chkIn" type="text" class="datepicker" id="datepicker" autocomplete="off" readonly value="{{ request('chkIn') }}">
                    <label for="chk_out">~</label>
                    <input name="chkOut" type="text" class="datepicker2" id="datepicker2" autocomplete="off" readonly value="{{ request('chkOut') }}">
                </div>
                {{-- <select name="reserveStatus" size="1" class="selectList" id="select_2">
                    <option  selected>전체</option>
                    <option value="0" >예약완료</option>
                    <option value="1" >예약대기</option>
                </select> --}}
                <label>
                    <input type="radio" name="reserveStatus" value="" onclick="updateRadioValue(this)" @if(empty(request('reserveStatus'))) checked @endif> 전체
                </label>
                <label>
                    <input type="radio" name="reserveStatus" value="0" onclick="updateRadioValue(this)" @if(empty(request('reserveStatus'))) checked @endif> 예약대기
                </label>
                <label>
                    <input type="radio" name="reserveStatus" value="1" onclick="updateRadioValue(this)" @if(empty(request('reserveStatus'))) checked @endif> 예약완료
                </label>
                <br>
                <select name="searchType" size="1" class="selectList" id="select_1">
                    <option value="id" @if(request('searchType') === 'id') selected @endif>예약번호</option>
                    <option value="reserve_name" @if(request('searchType') === 'reserve_name') selected @endif>이름</option>
                    <option value="reserve_num" @if(request('searchType') === 'reserve_num') selected @endif>전화번호</option>
                </select>
            
                <input class="input" type="text" name="keyword" autocomplete="off" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-dark">검색</button>
            </form>
        </div>
    <div class="searchUl">
            <div class="searchList">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">예약번호</th>
                        <th scope="col">예약숙소/객실</th>
                        <th scope="col">예약자</th>
                        <th scope="col">휴대폰</th>
                        <th scope="col">예약일시</th>
                        {{-- <th scope="col">가격</th> --}}
                        <th scope="col">처리현황</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $val)
                    <tr>
                        <td class="td_chk">{{ $val->reserve_id }}</td>
                        <td class="td_chk">{{ $val->hanok_name }}/{{ $val->room_name }}</td>
                        <td class="td_chk">{{ $val->reserve_name }}</td>
                        <td class="td_chk">{{ $val->reserve_num }}</td>
                        <td class="td_chk">{{ $val->created_at }}</td>
                        {{-- <td class="td_chk">{{ $val->re }}</td> --}}
                        <td class="td_chk">
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
<!-- 라디오 버튼 값을 쿠키로 저장 -->
<script>
    // 라디오 버튼 값을 쿠키에 저장하는 기능
    function updateRadioValue(radio) {
        document.cookie = "reserveStatus=" + radio.value;
    }

    // 쿠키에서 저장된 라디오 버튼 값을 불러오는 기능
    function loadRadioValue() {
        const cookies = document.cookie.split('; ');
        for (const cookie of cookies) {
            const [name, value] = cookie.split('=');
            if (name === "reserveStatus") {
                const radios = document.getElementsByName("reserveStatus");
                for (const radio of radios) {
                    if (radio.value === value) {
                        radio.checked = true;
                        break;
                    }
                }
            }
        }
    }

    // 페이지가 로드될 때 저장된 라디오 버튼 값을 로드
    window.onload = function() {
        loadRadioValue();
    };
</script>
@endsection