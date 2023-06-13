@extends('layout.layout')

@section('contents')
    <div class="hotel">
    <div style="overflow:hidden">
        캐러셀
        <div>
            사진
        </div>
    </div>
    <div>
        <span>숙소 이름</span>
        <span>평균별점</span>
        <button>찜(하트모양 이미지)</button>
        <span>찜 갯수</span>
        <span>사장 한 마디</span>
    </div>
</div>
<div class="detailTap">
    <button>객실선택</button> {{-- 누르면 토글로 해당 div나타남 기본적으로 객실선택 --}}
    <button>위치</button>
    <button>서비스</button>
    <button>정책</button>
    <button>후기</button>
</div>
<div class="room">
    <div>06-13 ~ 06-14</div>
    <div>
        <input type="date" name="date" id="date"> {{-- 캘린더로 최대 7박까지 선택 가능하게 --}}
        <button>적용</button>
    </div>
    <div>{{--예약 가능한 객실 없으면 '선택하신 날짜에 예약가능한 객실이 없습니다. 날짜를 다시 선택해주세요' 출력 이미 예약 된 객실은 뜨면 안 됨--}}
        <button>객실 이용 안내 ></button>{{-- 이거 누르면 모달창으로 뜨기 --}}
    </div>
</div>
<div class="addr">
    <div>카카오맵</div>
    <div>주소
        <button>주소복사</button>
    </div>
</div>
<div class="service">서비스
    <div>어메니티 아이콘</div>
</div>
<div class="policy">환불정책 등등</div>
<div class="review">리뷰
    <div>평균 별점이랑 리뷰 갯수</div>
    <div>리뷰 없으면 '아직 리뷰가 작성되지 않았습니다.' 출력</div>
</div>
@endsection