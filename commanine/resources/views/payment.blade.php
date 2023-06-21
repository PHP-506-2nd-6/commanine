<div>
    <div>
        <p>{{$data->hanok_name}}</p>
        <p>{{$data->room_name}}</p>
    </div>
    <div>
        <p>체크인</p>
        <p>{{$data->chk_in}}</p>
    </div>
    <div>
        <p>체크아웃</p>
        <p>{{$data->chk_out}}</p>
    </div>
    <form action="" method="post">
    <div>
        <h1>예약자 정보</h1>
        <label for="reserve_name">예약자 이름</label>
        <input type="text" name="reserve_name" id="reserve_name">
        <label for="reserve_email">예약자 이메일</label>
        <input type="text" name="reserve_email" id="reserve_email">
        <label for="reserve_num">예약자 전화 번호</label>
        <input type="text" name="reserve_num" id="reserve_num">
    </div>
    <div>
        <h1>결제 금액</h1>
        <div>
            <p>상품 금액 : {{$data->room_price}}</p>
            <p>총 결제 금액 : {{$data->room_price}}</p>
        </div>
    </div>
    <div>
        <h1>결제 수단</h1>
        <input type="text" name="reserve_method" id="reserve_method" value="신용카드">
    </div>
    <button type="submit">결제 하기</button>
    <button type="button">취소</button>
    </form>

</div>