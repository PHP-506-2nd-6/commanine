@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminUsers.css')}}"> 
</head>
@section('contents')
    <div class="container row main-container ">
        @include('layout.adminsidebar')
            <div class="container col-9 content-box">
                <h2>객실 등록하기</h2>
                <div class="hanok">
                    <div>
                        <h3>숙소명</h3>
                        <div>{{$hanoks->hanok_name}}</div>
                    </div>
                    <div>
                        <h3>숙소 주소</h3>
                        <div>{{$hanoks->hanok_addr}}</div>
                    </div>
                </div>
                <div class="rooms">
                    @include('layout.errors_validate')
                    <form action="{{route('admin.rooms.insert.post',['hanok_id'=> $hanoks->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="room_name">객실 명</label>
                            <input type="text" name="room_name">
                        </div>
                        <div>
                            <label for="room_content">객실 설명</label>
                            <textarea type="text" name="room_content"></textarea>
                        </div>
                        <div>
                            <label for="room_price">객실 가격</label>
                            <input type="number" name="room_price">
                        </div>
                        <div>
                            <label for="room_min">최소 수용 가능 인원</label>
                            <input type="number" min="2" max="16" name="room_min" value="2">
                        </div>
                        <div>
                            <label for="room_max">최대 수용 가능 인원</label>
                            <input type="number" min="2" max="16" name="room_max" value="2">
                        </div>
                        <div>
                            <label for="chk_in">체크인</label>
                            <input type="time" name="chk_in">
                        </div>
                        <div>
                            <label for="chk_out">체크아웃</label>
                            <input type="time" name="chk_out">
                        </div>
                        <div>
                            <label for="room_detail">객실 상세설명</label>
                            <textarea type="text" name="room_detail"></textarea>
                        </div>
                        <div>
                            <label for="room_facility">편의시설</label>
                            <textarea type="text" name="room_facility"></textarea>
                        </div>
                        <div>
                            <div>객실 이미지</div>
                            <div>
                                <label for="room_img1">이미지1</label>
                                <input type="file" class="img" name="room_img1" multiple>
                            </div>
                            <div>
                                <label for="room_img2">이미지2</label>
                                <input type="file" class="img" name="room_img2">
                            </div>
                            <div>
                                <label for="room_img3">이미지3</label>
                                <input type="file" class="img" name="room_img3">
                            </div>
                        </div>
                        <div>
                            <button>등록하기</button>
                            <button type="button" onclick="location.href='{{route('admin.hanoks.detail',[ 'hanok_id' => $hanoks->id ])}}' ">취소하기</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
@endsection