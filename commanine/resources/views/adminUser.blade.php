@extends('layout.adminlayout')

@section('contents')
    <form action="">
        <input type="text">
        <button type="submit">검색</button>
    </form>
    <table>
    <caption>유저 관리</caption>
    <thead>
    <tr>
        <th scope="col"><a href="">유저이메일</a></th>
        <th scope="col">이름</th>
        <th scope="col">생년월일</th>
        <th scope="col"><a href="">전화번호</a></th>
        <th scope="col">탈퇴 여부</th>
    </tr>
    </thead>
    <tbody>
    @foreach($variable as $key => $value)
    <tr class="bg0">
        <td class="td_chk">
        </td>
        <td class="td_left">2023-07-19 첫로그인</td>
        <td class="td_num td_pt">100</td>
        <td class="td_datetime">2023-07-19 00:11:50</td>
        <td class="td_datetime2">
            2023-10-26        </td>
        <td class="td_num td_pt">2,147,483,647</td>
    </tr>
    @endforeach

@endsection