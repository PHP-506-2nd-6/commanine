{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : Views
 * 파일명     : findpw.blade.php
 * 이력       : 0613 KMH new
 * *********************************** */ --}}
 @extends('layout.layout')
{{-- @section('title','Find Password') --}}
@section('contents')
    <div>비밀번호 찾기</div>
    @include('layout.errors_validate')
    <form action="{{route('users.findPw.post')}}" method="post">
        @csrf
        <input type="text" name="email" id="email" placeholder="이메일">
        <br>
        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="전화번호" max="11">
        <br>
        <select name="question" size="1">
			<option value="1">나의 보물1호는 무엇입니까?</option>
			<option value="2">출생지는 어디 입니까?</option>
			<option value="3">어머니의 성함은 무엇입니까?</option>
            <option value="4">아버지의 성함은 무엇입니까?</option>
            <option value="5">졸업한 초등학교 이름은 무엇입니까?</option>
		</select>
        <br>
        <input type="text" name="questAnswer" id="questAnswer" placeholder="질문의 답">
        <br>
        <button type="submit">비밀번호 찾기</button>
        <button type="button">취소</button>
    </form>
@endsection