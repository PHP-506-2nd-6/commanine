@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminHanokDetail.css')}}"> 
</head>
@section('contents')
    <div class=" row main-container ">
        @include('layout.adminsidebar')
        <div class="col-9 d-flex row" >
            <div class="hanoks-container">
                <div class="d-flex justify-content-between hanoks">
                    <h2  >숙소 상세관리</h2>
                    <button type="button" class=" btn btn-outline-dark ml-auto" onclick="location.href='{{route('admin.rooms.insert',[ 'hanok_id' => $hanoks->id ])}}'">객실 등록</button>
                </div>
                @include('layout.errors_validate')
                <div class="hanoks" >
                    <form action="{{route('admin.hanoks.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="hanok_id"value="{{$hanoks->id}}">
                        <div class="d-flex align-items-center">

                            <label for="hanok_name" class="col-2 hanok-tit">숙소 이름</label>   
                            <input type="text" name="hanok_name" class= "col-10 hanok-con" value="{{isset($hanoks->hanok_name) ? $hanoks->hanok_name : ""}}">
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="hanok_addr" class="col-2 hanok-tit">주소</label>
                            <input type="text" name="hanok_addr" id="hanok_addr" class= "col-10 hanok-con" value="{{isset($hanoks->hanok_addr) ? $hanoks->hanok_addr : ""}}">
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="hanok_num" class="col-2 hanok-tit">숙소 전화번호</label>
                            <input type="number" name="hanok_num" id="hanok_num" class= "col-10 hanok-con" value="{{isset($hanoks->hanok_num) ? $hanoks->hanok_num : ""}}">
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="hanok_refund" class="col-2 hanok-tit">숙소 타입</label>
                                @if($hanoks->hanok_type == 0)
                                    <select name="hanok_type" class="select_box" class= "col-10 hanok-con">
                                        <option value="0" selected>호텔</option>
                                        <option value="1">펜션</option>
                                        <option value="2">게스트하우스</option>
                                        <option value="3">리조트</option>
                                    </select>
                                @elseif($hanoks->hanok_type == 1)
                                    <select name="hanok_type" class="select_box" class= "col-10 hanok-con">
                                        <option value="0" >호텔</option>
                                        <option value="1" selected>펜션</option>
                                        <option value="2">게스트하우스</option>
                                        <option value="3">리조트</option>
                                    </select>
                                @elseif($hanoks->hanok_type == 2)
                                    <select name="hanok_type" class="select_box" class= "col-10 hanok-con">
                                        <option value="0" >호텔</option>
                                        <option value="1" >펜션</option>
                                        <option value="2" selected>게스트하우스</option>
                                        <option value="3">리조트</option>
                                    </select>
                                @else
                                    <select name="hanok_type" class="select_box" class= "col-10 hanok-con">
                                        <option value="0" >호텔</option>
                                        <option value="1" >펜션</option>
                                        <option value="2" >게스트하우스</option>
                                        <option value="3" selected>리조트</option>
                                    </select>
                                @endif
                            {{-- </span> --}}
                        </div>
                        <div class="d-flex align-items-center">
                            <h3 class="col-2 hanok-tit">숙소 이미지</h3>
                            <div class="imgBox col-10 hanok-con d-flex justify-content-between">
                                <span >
                                    <img src="{{asset($hanoks->hanok_img1)}}" style="width:200px; height:150px;" >
                                </span>
                                <span >
                                    <img src="{{asset($hanoks->hanok_img2)}}" style="width:200px; height:150px;" >
                                </span>
                                <span >
                                    <img src="{{asset($hanoks->hanok_img3)}}" style="width:200px; height:150px;" >
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <h3  class="col-2 hanok-tit">숙소 이미지 변경</h3>
                            <div class="col-10 hanok-con d-flex justify-content-between">
                                <div class="preview-box" >
                                    <label for="hanok_img1">첫번째 사진</label>
                                    <input type="file" name="hanok_img1" id="hanok_img1" accept="image/*" onchange="preview(event, 'hanokImgPreview1')">
                                    <img id="hanokImgPreview1" src="#" alt="미리 보기" style="display: none; width: 200px; height: 150px;">

                                </div>
                                <div class="preview-box" >
                                    <label for="hanok_img2">두번째 사진</label>
                                    <input type="file" name="hanok_img2" id="hanok_img2" accept="image/*" onchange="preview(event, 'hanokImgPreview2')" >
                                    <img id="hanokImgPreview2" src="#" alt="미리 보기" style="display: none; width: 200px; height: 150px;">

                                </div>
                                <div class="preview-box" >
                                    <label for="hanok_img3">세번째 사진</label>
                                    <input type="file" name="hanok_img3" id="hanok_img3" accept="image/*" onchange="preview(event, 'hanokImgPreview3')">
                                    <img id="hanokImgPreview3" src="#" alt="미리 보기" style="display: none; width: 200px; height: 150px;">
                                </div>
                            </div>
                            {{-- <input type="file" name="room_img[]" multiple accept="image/*" class="col-10 room-con img-file "> --}}
                        </div>
                        @php
                            $hanok_comment = str_replace("<br />","\r\n",$hanoks->hanok_comment);
                            $hanok_info = str_replace("<br />","\r\n",$hanoks->hanok_info);
                            $hanok_refund = str_replace("<br />","\r\n",$hanoks->hanok_refund);
                            
                        @endphp
                        <div class="d-flex align-items-center">
                            <h3 class="col-2 amenity-tit">어메니티</h3>
                            <div class="col-10 d-flex row">
                                <div  class="d-flex" >
                                    <div class="d-flex">
                                        <label for="wifi" class="amenity">와이파이</label>
                                        <input type="checkbox" name="amenity[]" id="wifi" {{ in_array('0',$amenities) ? "checked" : "" }} value="0" >
                                    </div>
                                    <div class="d-flex">
                                        <label for="tv" class="amenity">TV</label>
                                        <input type="checkbox" name="amenity[]" id="wifi" {{ in_array('1',$amenities) ? "checked" : "" }} value="1">
                                    </div>
                                    <div class="d-flex">
                                        <label for="ac" class="amenity">에어컨</label>
                                        <input type="checkbox" name="amenity[]" id="ac" {{ in_array('2',$amenities) ? "checked" : "" }} value="2">
                                    </div>
                                    <div class="d-flex">
                                        <label for="refri" class="amenity">냉장고</label>
                                        <input type="checkbox" name="amenity[]" id="refri" {{ in_array('3',$amenities) ? "checked" : "" }} value="3">
                                    </div>
                                    <div class="d-flex">
                                        <label for="dryer" class="amenity">드라이기</label>
                                        <input type="checkbox" name="amenity[]" id="dryer" {{ in_array('4',$amenities) ? "checked" : "" }} value="4">
                                    </div>
                                    <div class="d-flex">
                                        <label  for="bathSupplies" class="amenity">욕실용품</label>
                                        <input type="checkbox" name="amenity[]" id="bathSupplies" {{ in_array('5',$amenities) ? "checked" : "" }} value="5">
                                    </div>
                                </div>
                                <div  class="d-flex" >
                                    <div class="d-flex">
                                        <label for="shower" class="amenity">샤워부스</label>
                                        <input type="checkbox" name="amenity[]" id="shower" {{ in_array('6',$amenities) ? "checked" : "" }} value="6">
                                    </div class="d-flex">

                                    <div class="d-flex">
                                        <label for="tub" class="amenity">욕조</label>
                                        <input type="checkbox" name="amenity[]" id="tub" {{ in_array('7',$amenities) ? "checked" : "" }} value="7">
                                    </div>

                                    <div class="d-flex">
                                        <label for="micro" class="amenity">전자레인지</label>
                                        <input type="checkbox" name="amenity[]" id="micro" {{ in_array('8',$amenities) ? "checked" : "" }} value="8"> 
                                    </div>

                                    <div class="d-flex">
                                        <label for="washing" class="amenity">세탁기</label>
                                        <input type="checkbox" name="amenity[]" id="washing" {{ in_array('9',$amenities) ? "checked" : "" }} value="9">
                                    </div>

                                    <div class="d-flex">
                                        <label for="dryerMachine" class="amenity">건조기</label>
                                        <input type="checkbox" name="amenity[]" id="dryerMachine" {{ in_array('10',$amenities) ? "checked" : "" }} value="10">
                                    </div>

                                    <div class="d-flex">
                                        <label for="parking" class="amenity">주차장</label>
                                        <input type="checkbox" name="amenity[]" id="parking" {{ in_array('11',$amenities) ? "checked" : "" }} value="11">
                                    </div>

                                    <div class="d-flex">
                                        <label for="bbq" class="amenity">BBQ</label>
                                        <input type="checkbox" name="amenity[]" id="bbq" {{ in_array('12',$amenities) ? "checked" : "" }} value="12">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="hanok_comment" class="col-2 hanok-tit">상세 내용</label>
                            <textarea type="text" name="hanok_comment"  class= "col-10 hanok-con" id="hanok_comment" rows="3" >{{isset($hanoks->hanok_comment) ?  $hanok_comment : "" }}</textarea>
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="hanok_info" class="col-2 hanok-tit">숙소 기본정보</label>
                            <textarea type="text" name="hanok_info" class= "col-10 hanok-con" id="hanok_info" rows="4">{{isset($hanoks->hanok_info) ?  $hanok_info : "" }}</textarea>
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="hanok_refund" class="col-2 hanok-tit">환불 정보</label>
                            <textarea type="text" name="hanok_refund" class= "col-10 hanok-con" id="hanok_refund" rows="3">{{isset($hanoks->hanok_refund) ?  $hanok_refund : "" }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-danger " >숙소 수정하기</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="line"></div>
            {{-- 객실 --}}
            <div class="rooms container">
                <h2 class="room-title" >객실 정보</h2>
                @forelse($rooms as $value)
                    <div class="rooms">
                        @if(session()->has('roomError'))
                            <div class="msg">{!!session('roomError')!!}</div>
                        @endif
                        <form action="{{route('admin.rooms.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="hanok_id"value="{{$hanoks->id}}">
                            <input type="hidden" name="room_id"value="{{$value->id}}">
                            @php
                                $room_content = str_replace("<br />","\r\n",$value->room_content);
                                $room_detail = str_replace("<br />","\r\n",$value->room_detail);
                                $room_facility = str_replace("<br />","\r\n",$value->room_facility);
                            @endphp
                            <div class="d-flex align-items-center">
                                <label for="room_name" class="col-2 room-tit">객실 명</label>
                                <input type="text" name="room_name" class="col-10 room-con" value="{{isset($value->room_name) ? $value->room_name : ""}}">
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="room_content" class="col-2 room-tit">객실 설명</label>
                                <textarea type="text" name="room_content" class="col-10 room-con">{{ isset($value->room_content) ? $room_content : "" }}</textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="room_price" class="col-2 room-tit">객실 가격</label>
                                <input type="text" name="room_price" class="col-10 room-con"  value="{{isset($value->room_price) ? number_format($value->room_price)  : ""}}" oninput="formatPrice(this)">
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="room_min" class="col-2 room-tit">최소 수용 가능 인원</label>
                                <input type="number" min="2" max="16" name="room_min" value="{{isset($value->room_min) ? $value->room_min : "2"}}" class="col-10 room-con" >
                            </div>
                            <div  class="d-flex align-items-center">
                                <label for="room_max" class="col-2 room-tit">최대 수용 가능 인원</label>
                                <input type="number" min="2" max="16" name="room_max" value="{{isset($value->room_max) ? $value->room_max : "2"}}" class="col-10 room-con">
                            </div>
                            <div  class="d-flex align-items-center">
                                <label for="chk_in" class="col-2 room-tit">체크인</label>
                                <input type="time" name="chk_in" class="col-10 room-con" value="{{isset($value->chk_in ) ? $value->chk_in : ""}}">
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="chk_out" class="col-2 room-tit">체크아웃</label>
                                <input type="time" name="chk_out" class="col-10 room-con" value="{{isset($value->chk_out ) ? $value->chk_out : ""}}">
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="room_detail" class="col-2 room-tit">객실 상세설명</label>
                                <textarea type="text" name="room_detail" class="col-10 room-con">{{ isset($value->room_detail) ? $room_detail : "" }}</textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <label for="room_facility" class="col-2 room-tit">편의시설</label>
                                <textarea type="text" name="room_facility" class="col-10 room-con">{{ isset($value->room_facility) ? $room_facility : "" }}</textarea>
                            </div>
                            {{-- <div class="d-flex align-items-center">
                                <label for="room_img1[]" class="col-2 room-tit">객실 이미지</label>
                                <input type="file" name="room_img[]" multiple accept="image/*" class="col-10 room-con img-file ">
                            </div> --}}
                            <div class="d-flex align-items-center">
                                <h3 class="col-2 room-tit">객실 이미지</h3>
                                <div class="imgBox col-10 room-con d-flex justify-content-between">
                                    <span >
                                        <img src="{{asset($value->room_img1)}}" style="width:200px; height:150px;" >
                                    </span>
                                    <span >
                                        <img src="{{asset($value->room_img2)}}" style="width:200px; height:150px;" >
                                    </span>
                                    <span >
                                        <img src="{{asset($value->room_img3)}}" style="width:200px; height:150px;" >
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <h3  class="col-2 room-tit">객실 이미지 변경</h3>
                                    <div class="col-10 hanok-con d-flex justify-content-between">
                                        <div class=" preview-box">
                                            <label for="room_img1">첫번째 사진</label>
                                            <input type="file" name="room_img1" id="room_img1" accept="image/*" onchange="preview(event, 'roomImgPreview1')">
                                            <img id="roomImgPreview1" src="#" alt="미리 보기" style="display: none; width: 200px; height: 150px;">

                                        </div>
                                        <div class=" preview-box">
                                            <label for="room_img2">두번째 사진</label>
                                            <input type="file" name="room_img2" id="room_img2" accept="image/*" onchange="preview(event, 'roomImgPreview2')" >
                                            <img id="roomImgPreview2" src="#" alt="미리 보기" style="display: none; width: 200px; height: 150px;">

                                        </div>
                                        <div class=" preview-box">
                                            <label for="room_img3">세번째 사진</label>
                                            <input type="file" name="room_img3" id="room_img3" accept="image/*" onchange="preview(event, 'roomImgPreview3')">
                                            <img id="roomImgPreview3" src="#" alt="미리 보기" style="display: none; width: 200px; height: 150px;">
                                        </div>
                                    </div>
                                {{-- <input type="file" name="room_img[]" multiple accept="image/*" class="col-10 room-con img-file "> --}}
                            </div>
                            {{-- <div class="d-flex align-items-center justify-content-end">
                                <div id="imageContainer" class= "col-10 hanok-con img-upload"></div>
                            </div> --}}
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-outline-danger room-btn" >객실 수정하기</button>
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="searchList noSearch" >등록된 객실이 없습니다.</div>
                @endforelse
                <div class="d-flex justify-content-center page-pad" > 
                    {{ $rooms->withQueryString()->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@if(session()->has('errMsg'))
    
<script>
    alert("{{ session('errMsg') }}")
</script>

@endif
<script src="{{asset('js/adminHanokUpdate.js')}}"></script>
