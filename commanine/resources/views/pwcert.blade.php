<div>
    <h1>비밀번호 인증</h1>
    <p>개인 정보 보호를 위해 비밀번호를 한번더 적어주시기 바랍니다</p>
    <br>
    @include('layout.errors_validate')
    <form action="{{route('users.unregist.pwchk.post')}}" method="post">
        @csrf
        <input type="hidden" name="pw_flg" value="{{$data}}">
        <input type="text" name="user_pw" placeholder="비밀번호를 적어주세요">
        <button type="submit">확인</button>
        <button type="button" onclick="location.href= '{{route('users.information.info')}}'">취소</button>
        @if({{$data}} === 0)
            <button type="button" onclick="location.href= '{{route('main')}}'">취소</button>
        @endif
    </form>
</div>