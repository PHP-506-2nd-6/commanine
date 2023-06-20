<div>
    <div>
        <ul>
            <li><a href="{{route('users.information.reserve')}}">예약 내역</a></li>
            {{-- <li><a href="{{route('users.information.dibs')}}">찜 목록</a></li> --}}
            <li><a href="{{route('users.information.info')}}">회원 정보</a></li>
            {{-- <li><a href="{{route('users.information.review')}}">내 리뷰</a></li> --}}
        </ul>
    </div>
    <div>
        @include('layout.errors_validate')
        <h1>회원 정보 수정</h1>
        <div>
            <div>이메일</div>
            <div>{{$data->user_email}}</div>
            <div>이름</div>
            <div>{{$data->user_name}}</div>
            <div>생년월일</div>
            <div>{{$data->user_birth}}</div>

            <form action="{{route('users.information.info.edit.post')}}" method = "post">
                @csrf
                <label for="user_num">전화번호</label>
                <input type="text" name="user_num" id="user_num" value="{{$data->user_num}}">
                <br>
                <label for="user_pw">새 비밀번호</label>
                <input type="password" name="user_pw" id="user_pw">
                <br>
                <label for="user_pwchk">새 비밀번호 확인</label>
                <input type="password" name="user_pwchk" id="user_pwchk">
                <input type="hidden" name="flg" value="2">
                <br>
                <br>
                <button type="button" onclick="location.href='{{route('users.unregist.pwchk')}}'">탈퇴하기</button>
                <button type="submit">수정하기</button>
                <button type="button" onclick="location.href='{{route('users.information.info')}}'">취소</button>
            </form>
        </div>
    </div>
</div>