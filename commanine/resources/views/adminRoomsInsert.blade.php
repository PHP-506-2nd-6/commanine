{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : adminRoomsInsert.blade.php
 * 이력       : 0720 v001 KMH new
 * *********************************** */ --}}
@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminRoomInsert.css')}}"> 
</head>
@section('contents')
    {{-- <div class="container row main-container " style="max-width:2000px"> --}}{{-- version2 --}}
    <div class="position-relative bg-white d-flex p-0">
        @include('layout.adminsidebar')
            <div class="container col-9 content-box ">
                <h3 class="title top-title">객실 등록하기</h3>
                <div class="hanoks-info">
                    <div class="d-flex align-items-center">
                        <h4 class="col-2 hanok-tit">숙소명</h4>
                        <div class= "col-10 hanok-con">{{$hanoks->hanok_name}}</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <h4 class="col-2 hanok-tit">숙소 주소</h4>
                        <div class="col-10 hanok-con">{{$hanoks->hanok_addr}}</div>
                    </div>
                </div>
                <div class="rooms">
                    @include('layout.errors_validate')
                    <form action="{{route('admin.rooms.insert.post',['hanok_id'=> $hanoks->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center">
                            <label for="room_name" class="col-2 room-tit">객실 명</label>
                            <input type="text" name="room_name" class="col-10 room-con">
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="room_content" class="col-2 room-tit">객실 설명</label>
                            <textarea type="text" name="room_content" class="col-10 room-con textarea-box"></textarea>
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="room_price" class="col-2 room-tit">객실 가격</label>
                            <input type="text" name="room_price" maxlength="13" id="room_price" class="col-10 room-con" style="width:200px;" oninput="onlyNumber(this);formatPrice(this);" >
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="room_min" class="col-2 room-tit">최소 수용 가능 인원</label>
                            <input type="number" min="2" max="16" name="room_min" value="2" class=" room-con text-center" style="width:200px;">
                            <label for="room_max" class="col-3 room-tit text-right">최대 수용 가능 인원</label>
                            <input type="number" min="2" max="16" name="room_max" value="2" class=" room-con text-center" style="width:200px;">

                        </div>
                        {{-- <div  class="d-flex align-items-center">
                            <label for="room_max" class="col-2 room-tit">최대 수용 가능 인원</label>
                            <input type="number" min="2" max="16" name="room_max" value="2" class="col-10 room-con text-center" style="width:200px;">
                        </div> --}}
                        <div  class="d-flex align-items-center">
                            <label for="chk_in" class="col-2 room-tit">체크인</label>
                            <input type="time" name="chk_in" class=" room-con text-center" style="width:200px;">
                            <label for="chk_out" class="col-3 room-tit text-right">체크아웃</label>
                            <input type="time" name="chk_out" class=" room-con text-center" style="width:200px;">

                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <label for="chk_out" class="col-2 room-tit">체크아웃</label>
                            <input type="time" name="chk_out" class="col-10 room-con text-center" style="width:200px;">
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <label for="room_detail" class="col-2 room-tit">객실 상세설명</label>
                            <textarea type="text" name="room_detail" class="col-10 room-con textarea-box"></textarea>
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="room_facility" class="col-2 room-tit">편의시설</label>
                            <textarea type="text" name="room_facility" class="col-10 room-con textarea-box"></textarea>
                        </div>
                        <div class="d-flex align-items-center ">
                            <div class="col-2 room-tit">
                                <label for="room_img1[]" >객실 이미지</label>
                                <div class="count-img">사진은 3장 등록해주세요.</div>
                            </div>
                            <input type="file" name="room_img[]" multiple accept="image/*" class="col-10 room-con img-file " onchange="readURL(this);">
                        </div>
                        <div class="d-flex justify-content-end hanoks">
                            <div id="imageContainer" class="col-10 d-flex justify-content-around preview-box"></div>
                        </div>
                        <div class="d-flex justify-content-end group-btn">
                            <button class="btn btn-outline-dark insert-btn col-5">등록하기</button>
                            <button type="button" class="btn btn-outline-danger col-5 cancel-btn ml-auto"  onclick="location.href='{{route('admin.hanoks.detail',[ 'hanok_id' => $hanoks->id ])}}' ">취소하기</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    @if(session()->has('errMsg'))
        <script>
            alert("{{session('errMsg')}}");
        </script>
    @endif
@endsection
<script src="{{asset('js/adminhanokupdate.js')}}"></script>
<script src="{{asset('js/adminhanoksinsert.js')}}"></script>