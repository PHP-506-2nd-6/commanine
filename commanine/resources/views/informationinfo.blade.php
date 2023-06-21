{{-- @section('contents') --}}
    <div>
        <div>
            <ul>
                <li><a href="{{route('users.information.reserve')}}">예약 내역</a></li>
                {{-- <li><a href="{{route('users.information.dibs')}}">찜 목록</a></li> --}}
                <li><a href="{{route('users.information.info')}}">회원 정보</a></li>
                <li><a href="{{route('users.information.review')}}">내 리뷰</a></li>
            </ul>
        </div>
        <div>
            <h1>회원 정보</h1>
            <div>이메일</div>
            <div>{{$data->user_email}}</div>
            <div>이름</div>
            <div>{{$data->user_name}}</div>
            <div>전화번호</div>
            <div>{{$data->user_num}}</div>
            <div>생년월일</div>
            <div>{{$data->user_birth}}</div>
            <button type="button" onclick="location.href='{{route('users.information.info.edit')}}'">회원 정보 수정</button>
        </div>
    </div>




{{-- @endsection --}}