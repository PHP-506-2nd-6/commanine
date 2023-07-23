@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminHanokDetail.css')}}"> 
</head>
@section('contents')
    <div class="container row main-container ">
        @include('layout.adminsidebar')
            <div class="container col-9 content-box" >
                <div class="d-flex justify-content-between hanoks">
                    <h2  >숙소 상세관리</h2>
                    <button type="button" class=" btn btn-outline-dark ml-auto" onclick="location.href='{{route('admin.rooms.insert',[ 'hanok_id' => $hanoks->id ])}}'">객실 등록</button>
                </div>
                <div class="hanoks" >
                    <form action="{{route('admin.hanoks.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="hanok_id"value="{{$hanoks->id}}">
                        <div class="d-flex align-items-center">
                            {{-- <h2 class="col-2 hanok-tit">숙소명</h2> --}}
                            {{-- <div class= "col-10 hanok-con">{{$hanoks->hanok_name}}</div> --}}
                            <label for="hanok_name" class="col-2 hanok-tit">숙소 이름</label>   
                            <input type="text" name="hanok_name" class= "col-10 hanok-con" value="{{isset($hanoks->hanok_name) ? $hanoks->hanok_name : ""}}">
                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <h3 class="col-2 hanok-tit">주소</h3>
                            <div class="col-10 hanok-con">{{$hanoks->hanok_addr}}</div>
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <label for="hanok_addr" class="col-2 hanok-tit">주소</label>
                            <input type="text" name="hanok_addr" id="hanok_addr" class= "col-10 hanok-con" value="{{isset($hanoks->hanok_addr) ? $hanoks->hanok_addr : ""}}">
                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <h3 class="col-2 hanok-tit">전화번호</h3>
                            <div class="col-10 hanok-con">{{$hanoks->hanok_num}}</div>
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <label for="hanok_num" class="col-2 hanok-tit">숙소 전화번호</label>
                            <input type="number" name="hanok_num" id="hanok_num" class= "col-10 hanok-con" value="{{isset($hanoks->hanok_num) ? $hanoks->hanok_num : ""}}">
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="hanok_refund" class="col-2 hanok-tit">숙소 타입</label>
                            {{-- <span class="col-10 hanok-con"> --}}
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
                        {{-- <div class="d-flex align-items-center">
                            <h3 class="col-2 hanok-tit">숙소 코멘트</h3>
                            <div class="col-10 hanok-con">{!! nl2br($hanoks->hanok_comment) !!}</div>
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <label for="hanok_comment" class="col-2 hanok-tit">상세 내용</label>
                            <textarea type="text" name="hanok_comment"  class= "col-10 hanok-con" id="hanok_comment" rows="3" >{!! isset($hanoks->hanok_comment) ? nl2br($hanoks->hanok_comment) : ""!!}</textarea>
                            {{-- <input type="text" name="hanok_comment" id="hanok_comment"> --}}
                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <h3 class="col-2 hanok-tit">숙소 정보</h3>
                            <div class="col-10 hanok-con">{!! nl2br($hanoks->hanok_info) !!}</div>
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <label for="hanok_info" class="col-2 hanok-tit">숙소 기본정보</label>
                            <textarea type="text" name="hanok_info" class= "col-10 hanok-con" id="hanok_info" rows="4">{!! isset($hanoks->hanok_info) ? nl2br($hanoks->hanok_info) : ""!!}</textarea>
                            {{-- <input type="text" name="hanok_info" id="hanok_info"> --}}
                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <h3 class="col-2 hanok-tit">환불 정보</h3>
                            <div class="col-10 hanok-con">{!! nl2br($hanoks->hanok_refund) !!}</div>
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <label for="hanok_refund" class="col-2 hanok-tit">환불 정보</label>
                            <textarea type="text" name="hanok_refund" class= "col-10 hanok-con" id="hanok_refund" rows="3">{!! isset($hanoks->hanok_refund) ? nl2br($hanoks->hanok_refund) : ""!!}</textarea>
                            {{-- <input type="text" name="hanok_refund" id="hanok_refund"> --}}
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-dark " >숙소 수정하기</button>
                        </div>
                    </form>
                </div>
                <div class="line"></div>
                {{-- 객실 --}}
                <div class="rooms">
                    <h2 class="room-title" >객실 정보</h2>
                    @forelse($rooms as $value)
                        <div class="rooms">
                            <form action="{{route('admin.rooms.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="hanok_id"value="{{$hanoks->id}}">
                                <input type="hidden" name="room_id"value="{{$value->id}}">

                                {{-- <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">객실 명</h3>
                                    <div class="col-10 room-con">{{$value->room_name}}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">객실 정보</h3>
                                    <div class="col-10 room-con">{!! nl2br($value->room_content) !!}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">객실 가격</h3>
                                    <div class="col-10 room-con">{{$value->room_price}}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">객실 이미지</h3>
                                    <img class="col-10 room-con" src="{{asset($value->room_img1)}}" style="width:250px; height:200px;" >
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">수용 가능 인원</h3>
                                    <div class="col-10 room-con">
                                        최소 : {{$value->room_min}} ~ 최대 : {{$value->room_max}}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">체크인 / 체크아웃</h3>
                                    <div class="col-10 room-con">체크인 : {{$value->chk_in}} / 체크아웃 : {{$value->chk_out}}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">객실 상세내용</h3>
                                    <div class="col-10 room-con">{!! nl2br($value->room_detail) !!}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h3 class="col-2 room-tit">객실 편의시설</h3>
                                    <div class="col-10 room-con">{{$value->room_facility}}</div>
                                </div> --}}
                                <div class="d-flex align-items-center">
                                    <label for="room_name" class="col-2 room-tit">객실 명</label>
                                    <input type="text" name="room_name" class="col-10 room-con" value="{{isset($value->room_name) ? $value->room_name : ""}}">
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="room_content" class="col-2 room-tit">객실 설명</label>
                                    <textarea type="text" name="room_content" class="col-10 room-con">{!! isset($value->room_content) ? nl2br($value->room_content) : "" !!}</textarea>
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
                                    <textarea type="text" name="room_detail" class="col-10 room-con">{!! isset($value->room_detail) ? nl2br($value->room_detail) : "" !!}</textarea>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="room_facility" class="col-2 room-tit">편의시설</label>
                                    <textarea type="text" name="room_facility" class="col-10 room-con">{!! isset($value->room_facility) ? nl2br($value->room_facility) : "" !!}</textarea>
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
                                    <button class="btn btn-outline-dark room-btn" >객실 수정하기</button>
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
