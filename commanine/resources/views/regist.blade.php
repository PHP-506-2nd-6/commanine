{{-- @section('contents') --}}
    <div>회원가입</div>
    <form action="{{route('users.regist.post')}}" method="post">
        @csrf
        <input type="text" name="name" id="name" placeholder="이름">
        <br>
        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="전화번호" max="11">
        <br>
        <input type="text" name="email" id="email" placeholder="이메일">
        <br>
        <button type="button" id="emailBtn">인증하기</button>
        <br>
        <input type="text" name="chkEmail" id="chkEmail" placeholder="인증번호">
        <button type="button" id="chkEmailBtn">확인하기</button>
        <br>
        <input type="password" name="password" id="password" placeholder="비밀번호">
        <br>
        <input type="password" name="passwordChk" id="passwordChk" placeholder="비밀번호 확인">
        <br>
        <input type="date" name="birth" id="birth" >
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
        <button type="submit">회원가입</button>
        
    </form>
    <script src="{{asset('js/regist.js')}}"></script>
{{-- @endsection --}}