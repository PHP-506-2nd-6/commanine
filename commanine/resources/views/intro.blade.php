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
        <h1 class="hanokis">한옥이란</h1>
        <div class="explain_vd">
            <p> 선사시대부터 우리나라에 우리 고유의 기술과 양식으로 지은 건축을 의미한다. <br>
            좁은 범위로는 ‘주거용 살림집’을 의미하며, 넓은 범위로는 ‘한국 전통건축 전체’를 포함한다. 
            한옥이라는 용어는 1907년부터 문헌에 등장하기 시작하였으며, 
            ‘우리나라 고유의 양식으로 지은 집을 양식 건물에 상대하여 부르는 말’이라고 정의되어 있다.
            한옥의 기원은 조선시대 후기에 전통한옥이 완성된 것으로 본다. 
            이 시기에 한옥은 공간구성의 기본단위인 온돌, 마루, 부엌이 완전히 결합하여 각 마당과 밀접한 관계를 갖게 되고 
            다양한 지역형으로 분화하게 되었다.</p>
            <div class="vd">
                <video src="{{asset('hanokvd.mp4')}}" controls>
            </div>
        </div>
    </div>
    {{-- <div class="vd">
        <video src="{{asset('hanokvd.mp4')}}" controls>
    </div> --}}
    <div class="subtit">
        <p class="ft-quotation mg-b40">
            <strong>최근 한옥은 다음과 같은 특징이 재조명되어 아파트와 다세대주택 등 기존 주거의 대안으로 큰 관심을 얻고 있다.</strong>
        </p>
    </div>
    <div class="intro_content">
        <div class="introbg">
            <img class="illhanok" src="{{asset('/img/illhanok.png')}}" alt="">
        </div>
        <div class="contentwrap">
            <div class="intro_cont cont1">
                <img class="contimg" src="{{asset('/img/hanokcon1.jpg')}}" alt="">
                <h3>자연과의조화</h3>
                <p>우리 조상들은 자연과의 조화를 최고의 이상으로 삼았으며, 
                따라서 한옥은 이를 반영하여 자연에 순응하여 계획되었다. 
                즉, 한옥은 주위의 환경과 어울리도록 집의 좌향을 잡고 그곳에서 나오는 재료를 사용하여 
                그곳의 지세에 맞는 형태로 지어졌다.
                이를 통해 한옥은 자연과 그 안에서 생활하는 인간이 하나가 되었다.</p>
            </div>
            <div class="intro_cont cont2">
                <h3>온돌의 따스함</h3>
                <p>아파트가 보편화된 현재까지도 우리나라 주거에서 볼 수 있는 대표적인 
                한옥의 건축요소는 온돌이다. 온돌은 공기가 아닌 바닥을 데우기 때문에 실내 환경이 쾌적하며,
                요리와 난방을 동시에 해결할 수 있어서 매우 효율적이고 효과적인 시스템이었다. 
                나무를 때서 직접 열을 내던 전통 온돌은 보일러가 도입되면서 물을 끓여 순환하는 방식으로 
                바뀌었다.</p>
            </div>
            <div class="intro_cont cont3">
                <img class="contimg" src="{{asset('/img/hanokcon2.jpg')}}" alt="">
                <h3>곡선의 아름다움</h3>
                <p>한옥의 지붕은 한옥의 인상을 결정하는데, 지붕의 아름다움은 날렵한 곡선에서 비롯된다. 
                자연스럽게 끝을 올린 한옥의 곡선은 중국과 일본의 전통건축에서 볼 수 있는 직선적인 지붕 형태에 비해 
                고전적인 아름다움을 지켜오고 있다.</p>
            </div>
            <div class="intro_cont cont4">
                <h3>친환경적인 건축</h3>
                <p>한옥에는 현대 건축에서 생기는 공해가 거의 없다. 
                한옥건물에 쓰인 재료들은 대부분 재활용이 가능하다. 
                돌과 나무는 인위적으로 가공하지 않은 자연상태 그대로 사용하였다. 
                또한 아파트 등 다른 재료의 건물에 비해 독성이 없어서 인간의 몸에 해롭지 않으며, 
                건물을 짓기 위해 터전을 훼손시키지 않는다.</p>
            </div>
            <div class="intro_cont cont5">
                <img class="contimg" src="{{asset('/img/hanokcon3.jpg')}}" alt="">
                <h3>열려있는 마루</h3>
                <p>온돌이 추위에 적응하기 위하여 발달된 건축요소라면, 
                마루는 더위에 적응하기 위하여 발달된 한옥의 건축요소이다. 
                마루는 바닥에서 떨어진 나무로 만든 공간이며, 
                바닥면의 습기가 닿지 않고 바람을 통하게 함으로써 쾌적한 여름을 보낼 수 있도록 한다. 
                또 마루는 여러 방을 연결하거나 물건을 보관하는 장소로도 이용된다.</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="seasons">
        <div class="title">
            <h4>season</h4>
            <p class=tit>한옥의 사계절</p>
        </div>
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