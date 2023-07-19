{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : main.blade.php
 * 이력       : 0614 BYJ new
 * *********************************** */ --}}
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{asset('css/intro.css')}}">
    <link rel="stylesheet" href="{{asset('css/commom.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>

@section('contents')
<div class="intro_wrap">
    <div class="introimgimg">
        <img class="introimg" src="{{asset('/img/intro.jpg')}}" alt="">
        <span class="introp">한옥에 빠지다</span>
    </div>
    <div class="explain">
        <h1>한옥이란</h1>
        <p> 선사시대부터 우리나라에 우리 고유의 기술과 양식으로 지은 건축을 의미한다. <br>
        좁은 범위로는 ‘주거용 살림집’을 의미하며, 넓은 범위로는 ‘한국 전통건축 전체’를 포함한다. 
        한옥이라는 용어는 1907년부터 문헌에 등장하기 시작하였으며, 
        ‘우리나라 고유의 양식으로 지은 집을 양식 건물에 상대하여 부르는 말’이라고 정의되어 있다.
         한옥의 기원은 조선시대 후기에 전통한옥이 완성된 것으로 본다. 
         이 시기에 한옥은 공간구성의 기본단위인 온돌, 마루, 부엌이 완전히 결합하여 각 마당과 밀접한 관계를 갖게 되고 
         다양한 지역형으로 분화하게 되었다.</p>
    </div>
    <p class="ft-quotation mg-b40">
        <strong>최근 한옥은 다음과 같은 특징이 재조명되어 아파트와 다세대주택 등 기존 주거의 대안으로 큰 관심을 얻고 있다.</strong>
    </p>
    <div class="intro_content">
        <div class="intro_content">
            <h2>자연과의조화</h2>
            <p>우리 조상들은 자연과의 조화를 최고의 이상으로 삼았으며, 
            따라서 한옥은 이를 반영하여 자연에 순응하여 계획되었다. 
            즉, 한옥은 주위의 환경과 어울리도록 집의 좌향을 잡고 그곳에서 나오는 재료를 사용하여 
            그곳의 지세에 맞는 형태로 지어졌다.
            이를 통해 한옥은 자연과 그 안에서 생활하는 인간이 하나가 되었다.</p>
        </div>
    </div>
    <div class="seasons">
        <div class="season">
            <img class="seasonimg" src="{{asset('/img/spring.jpg')}}" alt="">
            <p class="seasonp">봄</p>
        </div>
        <div class="season">
            <img class="seasonimg" src="{{asset('/img/summer.jpg')}}" alt="">
            <p class="seasonp">여름</p>
        </div>
        <div class="season">
            <img class="seasonimg" src="{{asset('/img/fall.jpg')}}" alt="">
            <p class="seasonp">가을</p>
        </div>
        <div class="season">
            <img class="seasonimg" src="{{asset('/img/winter.jpg')}}" alt="">
            <p class="seasonp">겨울</p>
        </div>
    </div>

</div>

    
@endsection