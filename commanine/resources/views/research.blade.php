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

<div class=" containerBox container" style="margin-top : 40px;">
    <div class="searchBox">
        <form action="{{route('research.page.get')}}" method="get" class="formBox">
            <div class="searchFirstBox" style="padding-bottom : 20px;">
                <input type="text" placeholder="지역명 / 숙소명" name="locOrHan" class="" value="{{$local}}">
                <div class="search_form2 dayBox">
                    <label for="chkIn">체크인</label>
                    <input type="text" class="datepicker" name="chkIn" value="{{$chkIn}}">
                    <label for="chkOut">체크아웃</label>
                    <input type="text" class="datepicker2" name="chkOut" value="{{$chkOut}}">
                </div>
            </div>
            <div class="searchSecondBox" >
                    <select name="hanokType"  size="1" class="selectBox" >
                        <option disabled selected value="">숙소 유형</option>
                        <option value="0">호텔</option>
                        <option value="1">펜션</option>
                        <option value="2">게스트 하우스</option>
                        <option value="3">리조트</option>
                    </select>
                    <div class="countWrap">
                        <label for="countP">인원</label>
                        <input type="text" class="countInput" id="countP"/>
                        <div class="countBox poAbsolute">
                            <div>
                                <label for="adults">성인</label>
                                <input type="number" value="2" class="adultsVal" id="adults" min="0" max="99">
                            </div>
                            <div>
                                <label for="kids">어린이  </label>
                                <input type="number" value="0" class="kidsVal" id="kids" min="0" max="99">
                            </div>
                            <button type="button" class="countChkBtn">확인</button>
                        </div>
                    </div>

                    {{-- range --}}
                    <div class="text-box">
                        <p class="centered-text">가격</p>
                        <div class="rangeslider">
                            <input class="min" name="minPrice" type="range" min="0" max="500000" value="0" step="10000" />
                            <input class="max" name="maxPrice" type="range" min="0" max="500000" value="500000" step="10000" />
                            <span class="range_min light left">0 원</span>
                            <span class="range_max light right">500000원</span>
                        </div>
                    </div>
                    
                {{-- range end --}}
            </div>
            {{-- 인원 클릭했을 때 밑에 창 나타나면서 type number로 바꾸고 설정 가능 할 수 있게 해야 함. --}}
                <input type="hidden" placeholder="성인" name="adults" id="adults" class="adultsHide" value="">
                <input type="hidden" placeholder="아동" name="kids" id="kids" class="kidsHide" value="">
            
            <button type="submit" class="searchBtn qtybtn" >Search</button>

        </form>
    </div>
            
    {{-- <ul>
        <li>가격 낮은 순</li>
        <li>가격 높은 순</li>
        <li>별점 순</li>
        <li>찜 많은 순</li>
    </ul> --}}
    <div class="searchList">
        @forelse($searches as $value)
            <div class="searchBox">
                <a href="{{route('hanoks.detail',$value->id)}}" class="">
                    <div class="">
                        <img src="{{asset($value->hanok_img1)}}" >
                    </div>
                    <div class="">
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
            <div class=" searchBox" >검색된 결과가 없습니다.</div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center"> 
        {{$searches->onEachSide(3)->withQueryString()->links()}}
    </div>
</div>

    
    <script src="{{asset('js/research.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

@endsection
