@extends('layout.adminlayout')

@section('contents')

    @include('layout.adminsidebar')
    <h2>숙소 상세관리</h2>

        <button type="button" onclick="location.href='{{route('admin.rooms.insert',[ 'hanok_id' => $hanoks->id ])}}'">객실 등록</button>

    <div class="hanoks">
        <div><h2>숙소명</h2>{{$hanoks->hanok_name}}</div>
        <div><h3>주소</h3>{{$hanoks->hanok_addr}}</div>
        <div><h3>전화번호</h3>{{$hanoks->hanok_num}}</div>
        <div>
            <h3>한옥타입</h3>
            <span>
                @if($hanoks->hanok_type === 0)
                    호텔
                @elseif($hanoks->hanok_type === 1)
                    펜션
                @elseif($hanoks->hanok_type === 2)
                    게스트하우스
                @else
                    리조트
                @endif
            </span>
        </div>
        <h3>숙소 이미지</h3>
        <div class="imgBox">
            <span >
                <img src="{{asset($hanoks->hanok_img1)}}" style="width:250px; height:200px;" >
            </span>
            <span >
                <img src="{{asset($hanoks->hanok_img2)}}" style="width:250px; height:200px;" >
            </span>
            <span >
                <img src="{{asset($hanoks->hanok_img3)}}" style="width:250px; height:200px;" >
            </span>
        </div>
        <div>
            <h3>숙소 코멘트</h3>
            <div>{!! nl2br($hanoks->hanok_comment) !!}</div>
        </div>
        <div>
            <h3>숙소 정보</h3>
            <div>{!! nl2br($hanoks->hanok_info) !!}</div>
        </div>
        <div>
            <h3>환불 정보</h3>
            <div>{!! nl2br($hanoks->hanok_refund) !!}</div>
        </div>
    </div>
    <div class="rooms">
        @forelse($rooms as $value)
            <div>
                <div>
                    <h3>객실 명</h3>
                    <div>{{$value->room_name}}</div>
                </div>
                <div>
                    <h3>객실 정보</h3>
                    <div>{!! nl2br($value->room_content) !!}</div>
                </div>
                <div>
                    <h3>객실 가격</h3>
                    <div>{{$value->room_price}}</div>
                </div>
                <div>
                    <div>{{$value->room_img1}}</div>
                </div>
                <div>
                    <h3>객실 수용 가능 인원</h3>
                    <div>
                        {{$value->room_min}} ~ {{$value->room_max}}
                    </div>
                </div>
                <div>
                    <h3>체크인 / 체크아웃</h3>
                    <div>체크인 : {{$value->chk_in}} / 체크아웃 : {{$value->chk_out}}</div>
                </div>
                <div>
                    <h3>객실 상세내용</h3>
                    <div>{!! nl2br($value->room_detail) !!}</div>
                </div>
                <div>
                    <h3>객실 편의시설</h3>
                    <div>{{$value->room_facility}}</div>
                </div>
            </div>
        @empty
            <div class="searchList noSearch" >등록된 객실이 없습니다.</div>
        @endforelse
        <div class="d-flex justify-content-center" > 
            {{ $rooms->withQueryString()->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection