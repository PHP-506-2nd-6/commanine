<head>
    <link rel="stylesheet" href="{{asset('css/payment.css')}}">
</head>
<div>
    <div>
        <p>{{$data->hanok_name}}</p>
        <p>{{$data->room_name}}</p>
    </div>
    </div>
    <form action="{{route('users.payment.comp')}}" method="post">
    @csrf
    <div>
        <p>체크인</p>
        <input type="hidden" name="chk_in_date" id="chk_in_date" value="{{$data->chk_in}}">
        <p>{{$data->chk_in}}</p>
    </div>
    <div>
        <p>체크아웃</p>
        <input type="hidden" name="chk_out_date" id="chk_out_date" value="{{$data->chk_out}}">
        <p>{{$data->chk_out}}</p>
    <div>
        <h1>예약자 정보</h1>
        <input type="hidden" name="room_id" id="room_id" value="{{$data->room_id}}">
        <input type="hidden" name="reserve_adult" id="reserve_adult" value="{{$data->reserve_adult}}">
        <input type="hidden" name="reserve_child" id="reserve_child" value="{{$data->reserve_child}}">
        @include('layout.errors_validate')
        <label for="reserve_name">예약자 이름</label>
        <input type="text" name="reserve_name" id="reserve_name">
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
        <select name="pay_type">
            <option value="신용카드">신용카드</option>
        </select>
    </div>
    <div>
        <input type='checkbox' name='selectall' value='selectall' onclick='selectAll(this)' required />
        <b>필수 약관 전체 동의</b>
        <br>
        <input type='checkbox' name='animal' value='dog' onclick='checkSelectAll()' required />
        만 14세 이상 이용 동의
        <br>
        <input type='checkbox' name='animal' value='cat' onclick='checkSelectAll()' required />
        개인 정보 수집 동의
        <br>
        <input type='checkbox' name='animal' value='rabbit' onclick='checkSelectAll()' required />
        개인 정보 제 3자 제공 동의
    </div>
    <br>
    <br>
    
    <button type="submit">결제하기</button>
    <button type="button" onclick="location.href='{{route('hanoks.detail', ['id' => $data->hanok_id])}}'">취소</button>
    </form>

</div>
<script src="{{asset('js/payment.js')}}"></script>