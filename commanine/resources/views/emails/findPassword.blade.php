@extends('emails.emaillayout')
@section('contents')
<table cellspacing="0"
cellpadding="0"
width="640px"
style="margin: 20px auto">
    <thead style="background-color:#F6F6F0">
        <tr>
            <th>
                <h1>COMMA,NINE</h1>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <h2>COMMA,NINE 임시 비밀번호 발급</h2>
                <!-- div 태그를 이용한 구역 설정 -->
                <div style="height: 200px; vertical-align:middle;">
                    <span style="display:inline-block;margin-top:10px;">임시비밀번호는 {{$pw}} 입니다.</span>
                    <br>
                    <br>
                    <a href="http://192.168.0.40/users/login"
                    style="color:#fff; background: #000; border-radius: 5px; padding: 10px 20px;display:inline-block;text-decoration:none;"
                    >로그인 하러 가기</a>
                    {{-- <ul>
                        <li>선택 사항 1</li>
                        <li>선택 사항 2</li>
                    </ul> --}}
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot style="height: 100px;background-color:#EDEDED; text-align:center; color:#545454">
        <tr>
            <td>
                본 메일은 발신전용 메일입니다.
                <br>
                Copyright©COMMA,NINE
            </td>
        </tr>
    </tfoot>
</table>
{{-- <div>
    인증번호는 {{$num}} 입니다.
</div> --}}
@endsection
{{-- <div>임시비밀번호는{{$pw}}입니다.</div> --}}