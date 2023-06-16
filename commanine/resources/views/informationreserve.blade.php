{{-- @section('contents') --}}
    <div>
        <div>
            <ul>
                <li><a href="{{route('users.information.reserve')}}">예약 내역</a></li>
                <li><a href="{{route('users.information.dibs')}}">찜 목록</a></li>
                <li><a href="{{route('users.information.info')}}">회원 정보</a></li>
                <li><a href="{{route('users.information.review')}}">내 리뷰</a></li>
            </ul>
        </div>
        <div>
            <h1>예약 내역</h1>
            <div>
                <img src="{{$data->room_img1}}" alt="">
                <div>숙소명</div>
                <div>{{$data->hanok_name}}</div>
                <div>객실명</div>
                <div>{{$data->room_name}}</div>
                <div>가격</div>
                <div>{{$data->room_price}}</div>
                <div>예약 날짜</div>
                <div>{{$data->chk_in}} ~ {{$data->chk_out}}</div>
                <div>인원</div>
                <div>{{$data->reserve_adult}}</div>
            </div>
        </div>
    </div>




{{-- @endsection --}}