{{-- @section('contents') --}}
    <div>아이디 찾기</div>
    <form action="{{route('users.findId.post')}}" method="post">
        @csrf
        <input type="text" name="name" id="name" placeholder="이름">
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
        <button type="submit">아이디 찾기</button>
        
    </form>
{{-- @endsection --}}