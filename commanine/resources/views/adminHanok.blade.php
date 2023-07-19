@extends('layout.adminlayout')

@section('contents')

    @include('layout.adminsidebar')
    <h2>숙소관리</h2>
    <form action="{{route('admin.hanoks')}}" method="get">
        <input type="text" placeholder="숙소명 / 주소 입력" name="hanoks">
        <button type="submit">검색</button>
    </form>
    <button onclick="location.href='{{route()}}'">숙소 등록</button>
    

    <div class="d-flex justify-content-center" > 
        {{ $users->withQueryString()->links('vendor.pagination.custom') }}
    </div>
@endsection