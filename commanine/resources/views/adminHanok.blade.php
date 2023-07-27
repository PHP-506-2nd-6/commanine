@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminHanok.css')}}"> 
</head>
@section('contents')
    {{-- <div class="container row main-container" style="max-width:2000px"> --}}{{--version2--}}
    <div class="position-relative bg-white d-flex p-0">
    @include('layout.adminsidebar')
    <div class="container col-9 content-box">
        <h2 class="top-title">숙소관리</h2>
        <div class="d-flex content-box-1">
            <form action="{{route('admin.hanoks.search')}}" class="col-9" method="get">
                <input type="text" placeholder="숙소명 / 주소 입력" name="hanoks" class="input">
                <button type="submit" class="btn btn-dark ">검색</button>
            </form>
            
                <button type="button" onclick="location.href='{{route('admin.hanoks.insert')}}'" class="btn btn-outline-dark col-2">숙소등록</button>
        </div>

        <div class="searchUl">
            @forelse($hanoks as $value)
                <div class="searchList">
                    {{-- <a href="{{route('hanoks.detail',$value->id)}}" class="listA"> --}}
                    <a href="{{route('admin.hanoks.detail',[ 'hanok_id' => $value->id ])}}" class="listA">
                        <div class="imgBox">
                            <img src="{{asset($value->hanok_img1)}}" style="width:220px; height:194px;" >
                        </div>
                        <div class="explainHanok">
                            <div class="nameHanok">
                                <div class="hanokName">{{$value->hanok_name}}</div>
                            </div>
                                <div class="reviewBox">{{$value->hanok_addr}}</div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="searchList noSearch" >검색된 결과가 없습니다.</div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center" > 
            {{ $hanoks->withQueryString()->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection