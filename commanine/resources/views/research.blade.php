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
                <div class="searchWidth tabFlex">
                    <label for="locOrHan">지역/숙소명</label>
                    <input type="text" id="locOrHan" placeholder="지역명 / 숙소명" name="locOrHan" autocomplete="off" class="localInput searchWidth " value="{{isset($arr['locOrHan']) ? $arr['locOrHan'] : ""}}">
                </div>
                <div class="dayBox searchWidth tabFlex">
                    <label for="chkIn">체크인</label>
                    <input type="text" id="chkIn" class="datepicker searchDate " autocomplete="off" readonly name="chkIn" value="{{isset($arr['chkIn']) ? $arr['chkIn'] : ""}}">
                </div>
                <div class="dayBox searchWidth tabFlex">
                    <label for="chkOut">체크아웃</label>
                    <input type="text" id="chkOut" class="datepicker2 searchDate " autocomplete="off" readonly name="chkOut" value="{{isset($arr['chkOut']) ? $arr['chkOut'] : ""}}">
                </div>
            </div>
            <div class="searchSecondBox" >
                    <div class="searchWidth selectBox tabFlex">
                        <span>숙소 유형</span>
                        @if(!isset($arr['hanoktype']))
                        <select name="hanoktype" size="1" class="selectList" id="select_1">
                            <option  selected>전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" >펜션</option>
                            <option value="2">게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @elseif($arr['hanoktype'] === "0")
                        <select name="hanoktype" size="1" class="selectList" id="select_1">
                            <option  >전체</option>
                            <option value="0" selected >호텔</option>
                            <option value="1">펜션</option>
                            <option value="2">게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @elseif($arr['hanoktype'] === "1")
                        <select name="hanoktype" size="1" class="selectList" id="select_1">
                            <option >전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" selected>펜션</option>
                            <option value="2">게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @elseif($arr['hanoktype'] === "2")
                        <select name="hanoktype" size="1" class="selectList" id="select_1">
                            <option >전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" >펜션</option>
                            <option value="2" selected>게스트 하우스</option>
                            <option value="3">리조트</option>
                        </select>
                        @else
                        <select name="hanoktype" size="1" class="selectList" id="select_1">
                            <option >전체</option>
                            <option value="0" >호텔</option>
                            <option value="1" >펜션</option>
                            <option value="2" >게스트 하우스</option>
                            <option value="3" selected>리조트</option>
                        </select>
                        @endif

                    </div>
                    <div class="countWrap searchWidth">
                        <div class="countPeople tabFlex">
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
                    <div class="text-box searchWidth tabFlex">
                        <div >가격</div>
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
            {{-- <a href="{{route('research.page.get',['reset' => '1', 'locOrHan' => $arr['locOrHan'], 'chkIn' => $arr['chkIn'], 'chkOut' => $arr['chkOut'] ])}}"><button type="button" id="reset" class="reset" >초기화</button></a> --}}
            <a href="{{route('research.page.get')}}" style="text-align: right;"><button type="button" id="reset" class="reset" style="border:none;"><img src="{{asset('img/icon/reset.png')}}" style="width:30px; height:30px; background-color: #fff; border: 2px solid #000; border-radius: 5px;" ></button></a>

        </form>
    </div>
    <div class = "range_1">
        <ul class = "range_2">
            <a href="{{route('research.page.get', array_merge($arr, ['range' => '0']) );}}" onclick="li_focus(event, 'li_focus_1')" class="li_focus_1"><li class="li_type">가격 낮은 순</li></a>
            <a href="{{route('research.page.get', array_merge($arr, ['range' => '1']) );}}" onclick="li_focus(event, 'li_focus_2')" class="li_focus_2"><li class="li_type">가격 높은 순</li></a>
            <a href="{{route('research.page.get', array_merge($arr, ['range' => '2']) );}}" onclick="li_focus(event, 'li_focus_3')" class="li_focus_3"><li class="li_type">리뷰 순</li></a>
            <a href="{{route('research.page.get', array_merge($arr, ['range' => '3']) );}}" onclick="li_focus(event, 'li_focus_4')" class="li_focus_4"><li class="li_type">별점 순</li></a>
        </ul>
    </div>

    <div class="searchUl">
        @forelse($searches as $value)
            <div class="searchList">
                {{-- <a href="{{route('hanoks.detail',$value->id)}}" class="listA"> --}}
                <a href="{{route('hanoks.detail',[ 'id' => $value->id, 'chk_in' => $arr['chkIn'], 'chk_out' => $arr['chkOut'], 'reserve_adult' => $arr['adults'], 'reserve_child' => $arr['kids'] ])}}" class="listA">
                    <div class="imgBox">
                        <img src="{{asset($value->hanok_img1)}}" >
                    </div>
                    <div class="explainHanok">
                        <div class="nameHanok">
                        {{-- 숙소명 --}}
                            <div class="hanokName">{{$value->hanok_name}}</div>
                        {{-- </div>
                        <div class="reviewHanok"> --}}
                            {{-- <span><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span> --}}
                        {{-- 별점 평균 --}}
                            <div class="reviewBox"><img src="{{asset('img/icon/star.png')}}" alt="star" class="star">{{isset($value->rate) ? substr($value->rate,0,3) : "0"}} ({{$value->cnt}})</div>
                        {{-- 리뷰 개수 --}}
                            {{-- <span>({{$value->cnt}})</span> --}}
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
