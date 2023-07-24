@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminUsers.css')}}"> 
</head>
@section('contents')
    <div class="container row main-container" style="max-width:2000px">
        @include('layout.adminsidebar')
        <div class="container col-9 content-box">
            <h2 >유저 관리</h2>
            <form action="{{route('admin.users.search')}}" method="get" class="form" >
                <input type="text" placeholder="이메일/이름 입력" name="users" class="input">
                <button type="submit" class="btn btn-dark">검색</button>
            </form>
            <div >
                <table class="table">
                    <thead >
                        <tr>
                            <th scope="col">유저이메일</th>
                            <th scope="col">이름</th>
                            <th scope="col">생년월일</th>
                            <th scope="col">전화번호</th>
                            <th scope="col">생성 일자</th>
                            <th scope="col">탈퇴 일자</th>
                            <th scope="col">비밀번호 리셋</th>
                            <th scope="col">회원탈퇴</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $key => $val)
                    <tr class="bg0">
                        <td class="td_chk">{{$val->user_email}}</td>
                        <td class="td_chk">{{$val->user_name}}</td>
                        <td class="td_chk">{{$val->user_birth}}</td>
                        <td class="td_chk">{{$val->user_num}}</td>
                        <td class="td_chk">{{$val->created_at}}</td>
                        <td class="td_chk">{{isset($val->deleted_at) ? $val->deleted_at : ""}}</td>
                        <td class="td_chk">
                            <form class="frm" action="{{route('admin.users.pw.reset',['user_id' => $val->user_id])}}" method="POST"
                                onsubmit="return confirm('{{$val->user_name}}회원의 비밀번호를 리셋하시겠습니까?');">
                                @csrf
                                <button type="submit" class="btn btn-primary">리셋</button>
                            </form>
                        </td>
                        {{-- <td class="td_chk"><button type="button">리셋</button></td> --}}
                        {{-- <td class="td_chk"><button type="button" onclick="location.href='{{route('admin.users.unregist',['user_id' => $val->user_id])}}'">탈퇴</button></td> --}}
                        <td class="td_chk">
                            <form class="frm" action="{{route('admin.users.unregist',['user_id' => $val->user_id])}}" method="POST"
                                onsubmit="return confirm('{{$val->user_name}}회원의 탈퇴를 진행하시겠습니까?');">
                                @csrf
                                <button type="submit" class="{{isset($val->deleted_at)? 'btn btn-secondary' : 'btn btn-danger'}}" {{isset($val->deleted_at) ? "disabled" : ""}}>탈퇴</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>검색된 결과가 없습니다.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center" > 
                {{ $users->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection