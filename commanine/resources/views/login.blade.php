{{-- @section('contents') --}}
    <a href="{{route('users.regist')}}">회원가입</a>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <input type="text" name="email" id="email" placeholder="아이디">
        <input type="password" name="password" id="password" placeholder="비밀번호">
        <button type="submit">Log in</button>
    </form>
    <a href="{{route('users.findId')}}">아이디 찾기</a>
    <a href="{{route('users.findPw')}}">비밀번호 찾기</a>
{{-- @endsection --}}