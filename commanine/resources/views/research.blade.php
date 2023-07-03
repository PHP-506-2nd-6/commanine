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

<div class="containerBox" style="margin-top : 40px;">
    <div class="searchBox">
        <form action="{{route('research.page.get')}}" method="get" class="formBox">
            <div class="searchFirstBox" style="padding-bottom : 10px;">
                <div class="searchWidth">
                    <label for="locOrHan">지역명 / 숙소명</label>
                    <input type="text" id="locOrHan" placeholder="지역명 / 숙소명" name="locOrHan" autocomplete="off" class="localInput searchWidth " value="{{isset($arr['local']) ? $arr['local'] : ""}}">
                </div>
                <div class="dayBox searchWidth">
                    <label for="chkIn">체크인</label>
                    <input type="text" id="chkIn" class="datepicker searchDate " autocomplete="off" readonly name="chkIn" value="{{isset($arr['chkIn']) ? $arr['chkIn'] : ""}}">
                </div>
                <div class="dayBox searchWidth ">
                    <label for="chkOut">체크아웃</label>
                    <input type="text" id="chkOut" class="datepicker2 searchDate " autocomplete="off" readonly name="chkOut" value="{{isset($arr['chkOut']) ? $arr['chkOut'] : ""}}">
                </div>
            </div>
            <div class="searchSecondBox" >
                    <div class="searchWidth selectBox">
                        <span>숙소 유형</span>
                        @if(!isset($arr['hanoktype']))
                        <select name="hanokType" size="1" class="selectList">
                            <option  selected>전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" >펜션</option>
                            <option value="2">게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @elseif($arr['hanoktype'] === "0")
                        <select name="hanokType" size="1" class="selectList">
                            <option  >전체</option>
                            <option value="0" selected >호텔</option>
                            <option value="1">펜션</option>
                            <option value="2">게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @elseif($arr['hanoktype'] === "1")
                        <select name="hanokType" size="1" class="selectList">
                            <option >전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" selected>펜션</option>
                            <option value="2">게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @elseif($arr['hanoktype'] === "2")
                        <select name="hanokType" size="1" class="selectList">
                            <option >전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" >펜션</option>
                            <option value="2" selected>게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @else
                        <select name="hanokType" size="1" class="selectList">
                            <option >전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" >펜션</option>
                            <option value="2" >게스트 하우스</option>
                            <option value="3" selected>리조트</option>
                        </select>
                        @endif

                    </div>
                    <div class="countWrap searchWidth">
                        <div class="countPeople">
                            <label for="countP">인원</label>
                            <input type="text" class="countInput" autocomplete="off" readonly id="countP" value="성인 : {{isset($arr['adults']) ? $arr['adults'] : "0" }} / 어린이 : {{isset($arr['kids']) ? $arr['kids'] : "0" }}"/>
                        </div>
                        <div class="countBox poAbsolute">
                            <div class="adultsBox">
                                <label for="adults">성인</label>
                                <div >
                                    <button class="minBtn" type="button">-</button>
                                    <input type="number" value="{{isset($arr['adults']) ? $arr['adults'] : "2" }}" class="adultsVal" autocomplete="off" id="adults" min="0" max="16">
                                    <button class="plusBtn" type="button">+</button>
                                </div>
                            </div>
                            <div class="kidsBox">
                                <label for="kids">어린이</label>
                                <div>
                                    <button class="minBtn" type="button">-</button>
                                    <input type="number" value="{{isset($arr['kids']) ? $arr['kids'] : "0" }}" class="kidsVal" autocomplete="off" id="kids" min="0" max="16">
                                    <button class="plusBtn" type="button">+</button>
                                </div>
                            </div>
                            <button type="button" class="countChkBtn">확인</button>
                        </div>
                    </div>

                    {{-- range --}}
                    <div class="text-box searchWidth">
                        <p class="centered-text">가격</p>
                        <div class="rangeslider">
                            <input class="min" name="minPrice" type="range" min="0" max="1000000" value="{{isset($arr['minPrice']) ? $arr['minPrice'] : "0"}}" step="10000" />
                            <input class="max" name="maxPrice" type="range" min="0" max="1000000" value="{{isset($arr['maxPrice']) ? $arr['maxPrice'] : "1000000" }}" step="10000" />
                            <span class="range_min light left">{{isset($arr['minPrice']) ? number_format($arr['minPrice']) : "0"}} 원</span>
                            <span class="range_max light right">{{isset($arr['maxPrice']) ? number_format($arr['maxPrice']) : "1000000" }} 원</span>
                        </div>
                    </div>
                    
                {{-- range end --}}
            </div>
            
                <input type="hidden" placeholder="성인" name="adults" id="adults" class="adultsHide" value="{{isset($arr['adults']) ? $arr['adults'] : "2" }}">
                <input type="hidden" placeholder="아동" name="kids" id="kids" class="kidsHide" value="{{isset($arr['kids']) ? $arr['kids'] : "0" }}">
            
            <button type="submit" id="searchBtn" class="searchBtn qtybtn" >Search</button>

        </form>
    </div>
            
    {{-- <ul>
        <li>가격 낮은 순</li>
        <li>가격 높은 순</li>
        <li>별점 순</li>
        <li>찜 많은 순</li>
    </ul> --}}
    <div class="searchUl">
        @forelse($searches as $value)
            <div class="searchList">
                <a href="{{route('hanoks.detail',$value->id)}}" class="listA">
                    <div class="imgBox">
                        <img src="{{asset($value->hanok_img1)}}" >
                    </div>
                    <div class="explainHanok">
                        <div class="nameHanok">
                        {{-- 숙소명 --}}
                            {{$value->hanok_name}}
                        </div>
                        <div class="reviewHanok">
                            <span><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span>
                        {{-- 별점 평균 --}}
                            <span>{{isset($value->rate) ? substr($value->rate,0,3) : "0"}}</span>
                        {{-- 리뷰 개수 --}}
                            <span>({{$value->cnt}})</span>
                        </div>
                        <div class="priceHanok">
                        {{-- 숙소 가격 --}}
                            {{number_format($value->room_price)}} / 1박
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="searchList noSearch" >검색된 결과가 없습니다.</div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center" > 
        {{-- {{$searches->onEachSide(5)->withQueryString()->links()}} --}}
        {{ $searches->withQueryString()->links('vendor.pagination.custom') }}
    </div>
</div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="{{asset('js/research.js')}}"></script>

@endsection
