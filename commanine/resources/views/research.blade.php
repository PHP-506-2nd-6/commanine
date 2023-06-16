{{--
 /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : research.blade.php
 * 이력       : 0616 KMH new
 * *********************************** */ 
 --}}
@extends('layout.layout')
{{-- <head>
    <link rel="stylesheet" href="{{asset('css/reseach.css')}}">
</head> --}}
@section('contents')
<div class="container">
    <form action="{{route('research.page.get')}}" method="get">
        <input type="text" placeholder="지역명 / 숙소명" name="locOrHan">
        <input type="date" name="chkIn">
        <input type="date" name="chkOut">
        <select name="hanokType" id="" size="1" >
            <option >숙소 유형</option>
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
            <input type="hidden" placeholder="성인" name="adults">
            <input type="hidden" placeholder="아동" name="kids">
            <button>확인</button>
        </div>
        <button type="submit">Search</button>
    </form>
    {{-- <ul>
        <li>가격 낮은 순</li>
        <li>가격 높은 순</li>
        <li>별점 순</li>
        <li>찜 많은 순</li>
    </ul> --}}
    {{-- @forelse($data as $key => $value)
        
    @empty --}}
        <div>검색된 결과가 없습니다.</div>
    {{-- @endforelse --}}

</div>

    {{-- @foreach($searches  as $search)
        <tr>
            <th scope="row">{{$search->id}}</th>
            <td>{{$search->hanok_name}}</td>
            <td>{{$search->hanok_img1}}</td>
        </tr>
    @endforeach --}}
@endsection
