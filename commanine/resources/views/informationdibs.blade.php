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
            <h1>찜 목록</h1>
            <div>
                <img src="{{$data->room_img1}}" alt="">
                <div>숙소명</div>
                <div>{{$data->hanok_name}}</div>
            </div>
        </div>
    </div>




{{-- @endsection --}}