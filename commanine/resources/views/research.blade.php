{{--
 /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : research.blade.php
 * 이력       : 0616 KMH new
 * *********************************** */ 
 --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/reseach.css')}}">
</head>
@section('contents')
<div class="container">
<br><br><br><br><br><br><br><br><br><br>
    <form action="{{route('research.page.get')}}" method="get">
        <input type="text" placeholder="지역명 / 숙소명" name="locOrHan">
        {{-- <div class="search_form2">
            <label for="chk_in">체크인</label>
            <input type="text" id="datepicker" class="hasDatepicker" name="chkIn">
            <button type="button" class="ui-datepicker-trigger">선택</button>
            <label for="chk_out">체크아웃</label>
            <input type="text" id="datepicker2" class="hasDatepicker" name="chkOut">
            <button type="button" class="ui-datepicker-trigger">선택</button>
        </div> --}}
        <div class="search_form2">
            <label for="chkIn">체크인</label>
            <input type="date" name="chkIn">
            <label for="chkOut">체크아웃</label>
            <input type="date"  name="chkOut">
        </div>
        <select name="hanokType" id="" size="1" >
            <option disabled selected value="">숙소 유형</option>
            <option value="0">호텔</option>
            <option value="1">펜션</option>
            <option value="2">게스트 하우스</option>
            <option value="3">리조트</option>
        </select>
        <div>인원</div>
        <label for="price">가격</label>
        <input type="range" step="50000" min="0" max="1000000" name="price" id="price">
        {{-- 인원 클릭했을 때 밑에 창 나타나면서 type number로 바꾸고 설정 가능 할 수 있게 해야 함. --}}
        <div>
            <label for="adults">성인 : </label>
            <input type="number" placeholder="성인" name="adults" id="adults">
            <label for="kids">어린이 : </label>
            <input type="number" placeholder="아동" name="kids" id="kids">
            <button type="button">확인</button>
        </div>
        <button type="submit">Search</button>
    </form>
    {{-- <ul>
        <li>가격 낮은 순</li>
        <li>가격 높은 순</li>
        <li>별점 순</li>
        <li>찜 많은 순</li>
    </ul> --}}
    @forelse($searches as $value)
        <div>
            {{$value->hanok_name}}
        </div>
        <div>
            <img src="{{asset($value->hanok_img1)}}" >
        </div>
        <div>
            {{$value->room_price}}
        </div>
    @empty
        <div>검색된 결과가 없습니다.</div>
    @endforelse

</div>
<div>
    {{$searches->onEachSide(3)->withQueryString()->links()}}
</div> 
    {{-- @foreach($searches  as $search)
        <tr>
            <th scope="row">{{$search->id}}</th>
            <td>{{$search->hanok_name}}</td>
            <td>{{$search->hanok_img1}}</td>
        </tr>
    @endforeach --}}
@endsection
