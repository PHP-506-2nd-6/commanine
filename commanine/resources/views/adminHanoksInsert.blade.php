<form action="{{route('admin.hanoks.insert.post')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
    <label for="hanok_name">숙소 이름</label>
    <input type="text" name="hanok_name" id="hanok_name">
    </div>
    <div>
    <label for="hanok_local">지역</label>
    <input type="text" name="hanok_local" id="hanok_local">
    </div>
    <div>
    <label for="hanok_comment">상세 내용</label>
    <input type="text" name="hanok_comment" id="hanok_comment">
    </div>
    <div>
    <label for="hanok_addr">주소</label>
    <input type="text" name="hanok_addr" id="hanok_addr">
    </div>
    <div>
    <label for="latitude">위도</label>
    <input type="text" name="latitude" id="latitude">
    </div>
    <div>
    <label for="longitude">경도</label>
    <input type="text" name="longitude" id="longitude">
    </div>
    <div>
    <label for="hanok_num">숙소 전화번호</label>
    <input type="text" name="hanok_num" id="hanok_num">
    </div>
    <div>
    <label for="hanok_info">숙소 기본정보</label>
    <input type="text" name="hanok_info" id="hanok_info">
    </div>
    <div>
    <label for="hanok_refund">환불 정보</label>
    <input type="text" name="hanok_refund" id="hanok_refund">
    </div>
    <select name="hanok_type">
        <option value="0" selected>호텔</option>
        <option value="1">펜션</option>
        <option value="2">게스트하우스</option>
        <option value="3">리조트</option>
    </select>
    <input type="file" name="hanok_img1[]" multiple>
    <input type="file" name="hanok_img2">
    <input type="file" name="hanok_img3">
    <button type="submit">제출하기</button>
    

</form>