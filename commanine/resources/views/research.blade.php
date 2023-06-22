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
    <link rel="stylesheet" href="{{asset('css/research.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
@section('contents')

<div class=" containerBox container row " style="margin-top : 40px;">

    <form action="{{route('research.page.get')}}" method="get" class="row formBox">
        <div class="row" style="padding-bottom : 20px;">
            <input type="text" placeholder="지역명 / 숙소명" name="locOrHan" class="col-3" value="{{$local}}">
            <div class="search_form2 col">
                <label for="chkIn">체크인</label>
                <input type="text" class="datepicker" name="chkIn" value="{{$chkIn}}">
                <label for="chkOut">체크아웃</label>
                <input type="text" class="datepicker2" name="chkOut" value="{{$chkOut}}">
            </div>
        </div>
        <div class="row" style="padding-bottom : 20px;">
                <select name="hanokType"  size="1" class="col" >
                    <option disabled selected value="">숙소 유형</option>
                    <option value="0">호텔</option>
                    <option value="1">펜션</option>
                    <option value="2">게스트 하우스</option>
                    <option value="3">리조트</option>
                </select>
                <div class="poRelative col ">
                    <label for="countP">인원</label>
                    <input type="text" class="col countInput" id="countP"/>
                    <div class="countBox poAbsolute">
                        <div>
                            <label for="adults">성인  </label>
                            <input type="number" value="2" class="adultsVal" id="adults" min="0" max="99">
                        </div>
                        <div>
                            <label for="kids">어린이  </label>
                            <input type="number" value="0" class="kidsVal" id="kids" min="0" max="99">
                        </div>
                        <button type="button" class="countChkBtn ">확인</button>
                    </div>
                </div>
                <label for="price" class="col-1">가격</label>
                <div class="col-4">
                    <div class="middle">
                        <div class="multi-range-slider">
                            <input type="range" id="input-left" min="0" max="1000000" value="0" name="minPrice" class="minInput" step="10000"/>
                            <input type="range" id="input-right" min="0" max="1000000" value="1000000" name="maxPrice" class="maxInput" step="10000"/>
                            <div class="slider">
                                <div class="track"></div>
                                <div class="range"></div>
                                <div class="thumb left"></div>
                                <div class="thumb right"></div>
                            </div>
                        </div>
                        <span class="minVal">0</span>
                        <span class="maxVal">1000000</span>
                    </div>
                </div>
            </div>
        
        
        {{-- 인원 클릭했을 때 밑에 창 나타나면서 type number로 바꾸고 설정 가능 할 수 있게 해야 함. --}}
            <input type="hidden" placeholder="성인" name="adults" id="adults">
            <input type="hidden" placeholder="아동" name="kids" id="kids">
        <button type="submit" class="searchBtn qtybtn" style="width : 200px; margin:0 auto">Search</button>
    </form>
    {{-- <div class="countBox">
        <div>
            <label for="adults">성인 : </label>
            <input type="number" value="2" class="adultsVal">
        </div>
        <div>
            <label for="kids">어린이 : </label>
            <input type="number" value="0" class="kidsVal">
        </div>
        <button type="button" class="countChkBtn">확인</button>
    </div> --}}
    {{-- <ul>
        <li>가격 낮은 순</li>
        <li>가격 높은 순</li>
        <li>별점 순</li>
        <li>찜 많은 순</li>
    </ul> --}}
    <div class="col searchList">
        @forelse($searches as $value)
            <div class="searchBox">
                <a href="{{route('hanoks.detail',$value->id)}}" class="row">
                    <div class="col-3">
                        <img src="{{asset($value->hanok_img1)}}" >
                    </div>
                    <div class="col-9">
                        <div>
                        {{-- 숙소명 --}}
                            {{$value->hanok_name}}
                        </div>
                        <div>
                        {{-- 리뷰 개수 --}}
                            <span><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span>
                            <span>{{$value->cnt}}</span>
                        {{-- 별점 평균 --}}
                            <span>{{isset($value->rate) ? $value->rate : "0"}}</span>
                        </div>
                        <div>
                        {{-- 숙소 가격 --}}
                            {{$value->room_price}} / 1박
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="row searchBox" >검색된 결과가 없습니다.</div>
        @endforelse
    </div>
    <div class = "pages"> 
        {{$searches->onEachSide(3)->withQueryString()->links()}}
    </div>
</div>

    
    <script src="{{asset('js/research.js')}}"></script>

@endsection
