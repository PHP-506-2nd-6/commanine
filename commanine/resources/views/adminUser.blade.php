@extends('layout.adminlayout')

@section('contents')
    <div class="container row">
        @include('layout.adminsidebar')
        <div class="container col-10">
            <h2>유저 관리</h2>
            <form action="{{route('admin.users.search')}}" method="get" class="form">
                <input type="text" placeholder="이메일/이름 입력" name="users">
                <button type="submit">검색</button>
            </form>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">유저이메일</th>
                            <th scope="col">이름</th>
                            <th scope="col">생년월일</th>
                            <th scope="col">전화번호</th>
                            <th scope="col">생성 일자</th>
                            <th scope="col">탈퇴 일자</th>
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