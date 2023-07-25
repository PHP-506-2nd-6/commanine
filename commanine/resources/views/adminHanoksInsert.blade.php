@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminhanoksinsert.css')}}">
</head>
@section('contents')
    <div class="container row main-container ">
    @include('layout.adminsidebar')
    <div class="container col-9 content-box ">
        <div class="rooms">
            <h1>숙소 등록하기</h1>
            <form action="{{route('admin.hanoks.insert.post')}}" class="grid_conn" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid_conn_1">
                <label for="hanok_name">숙소 이름</label>
                <input type="text" name="hanok_name" id="hanok_name" required>
                </div>
                <div class="grid_conn_1">
                <label for="hanok_local">지역</label>
                {{-- <input type="text" name="hanok_local" id="hanok_local"> --}}
                <textarea type="text" name="hanok_local" id="hanok_local" rows="1" required></textarea>
                {{-- <textarea type="text" name="room_content" class="col-10 room-con"></textarea> --}}
                </div>
                <div class="grid_conn_1">
                    <label for="hanok_comment">상세 내용</label>    
                    <textarea type="text" name="hanok_comment" id="hanok_comment" rows="3" required></textarea>
                    {{-- <input type="text" name="hanok_comment" id="hanok_comment"> --}}
                </div>
                <div class="grid_conn_1">
                    <label for="hanok_addr">주소</label>
                    <input type="text" name="hanok_addr" id="hanok_addr" required>
                </div>
                <div class="grid_conn_1">
                    <label for="latitude">위도</label>
                    <input type="text" name="latitude" id="latitude" required>
                </div>
                <div class="grid_conn_1">
                    <label for="longitude">경도</label>
                    <input type="text" name="longitude" id="longitude" required>
                </div>
                <div class="grid_conn_1">
                    <label for="hanok_num">숙소 전화번호</label>
                    <input type="number" name="hanok_num" id="hanok_num" required>
                </div>
                <div class="grid_conn_1">
                    <label for="hanok_info">숙소 기본정보</label>
                    <textarea type="text" name="hanok_info" id="hanok_info" rows="4" required></textarea>
                    {{-- <input type="text" name="hanok_info" id="hanok_info"> --}}
                </div>
                <div class="grid_conn_1">
                    <label for="hanok_refund">환불 정보</label>
                    <textarea type="text" name="hanok_refund" id="hanok_refund" rows="3" required></textarea>
                    {{-- <input type="text" name="hanok_refund" id="hanok_refund"> --}}
                </div>

                <div class="grid_conn_1">
                    <label for="hanok_refund">숙소 타입</label>
                    <select name="hanok_type" class="select_box">
                        <option value="0" selected>호텔</option>
                        <option value="1">펜션</option>
                        <option value="2">게스트하우스</option>
                        <option value="3">리조트</option>
                    </select>
                </div>
                <div class="grid_conn_1">
                    <label for="hanok_refund">어메니티 </label>
                    <div class="grid_conn_2">
                @for($i = 0; $i < count($data); $i++)
                        <div>
                            <input type="checkbox" id="{{$data[$i]->id}}" name="amenity_name[{{$data[$i]->id}}]" value="{{$i}}">
                            <label for="{{$data[$i]->id}}">{{$data[$i]->amenity_name}}</label>
                        </div>
                @endfor
                    </div>
                </div>
                {{-- <input type="file" name="hanok_img1[]" multiple accept="image/*" onchange="readURL(this);">
                <img id="preview" /> --}}
                <div class="grid_conn_1 room_img_size">
                        <label for="hanok_refund">객실 사진</label>
                    <div class="grid_conn_3">
                        <input type="file" name="hanok_img1[]" multiple accept="image/*" onchange="readURL(this);" required>
                        <div id="imageContainer"></div>
                    </div>
                </div>
                <div class="position">
                    <button type="submit" class="btn1">제출하기</button>
                    <button type="button" class="btn2">취소</button>
                </div>
                
            </form>
        </div>
    </div>
    </div>
@endsection
@if(session()->has('errMsg'))
    
<script>
    alert("{{ session('errMsg') }}")
</script>
@endif
<script src="{{asset('js/adminhanoksinsert.js')}}"></script>