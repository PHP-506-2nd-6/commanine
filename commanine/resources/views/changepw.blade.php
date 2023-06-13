@extends('layout.layout')

@section('contents')
    <h1>비밀번호 변경</h1>
    <form action="" method="post">
        <input type="password" name="password" id="password" placeholder="비밀번호(8~20자)">
        {{-- TODO 유효성 에러 '비밀번호 형식은 대소문자, 숫자, 특수문자 각 하나씩 8~20글자 입니다.'메세지 출력 --}}
        <input type="passwordchk" name="passwordchk" id="passwordchk" placeholder="비밀번호 재입력">
        {{-- TODO 비밀번호 불일치 시 '새 비밀번호와 새 비밀번호 확인이 일치하지 않습니다.'메세지 출력 --}}
        <button type="submit">비밀번호 변경</button>
    </form>
@endsection