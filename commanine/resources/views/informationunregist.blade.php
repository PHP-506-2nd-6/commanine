<div>
    <h1>회원 탈퇴</h1>
    <div>
        탈퇴시 복구가 불가능 합니다. <br> 탈퇴하시겠습니까?
    </div>
    <form action="{{route('users.information.unregist.comp')}}" method="post">
    @csrf
    <button type="submit" onclick="alert('탈퇴가 완료되었습니다')">탈퇴하기</button>
    </form>
    {{-- <form action="{{route('users.information.info')}}" method="get"> --}}
    <button type="button" onclick="location.href='{{route('users.information.info')}}'">취소</button>
    {{-- </form> --}}
</div>