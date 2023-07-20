@extends('layout.adminlayout')
<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminHanok.css')}}"> 
</head>
@section('contents')
    <div class="container row main-container ">
    @include('layout.adminsidebar')
    <div class="container col-9 content-box">
        <h2>숙소관리</h2>
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
                            <img src="{{asset($value->hanok_img1)}}" style="width:250px; height:200px;" >
                        </div>
                        <div class="explainHanok">
                            <div class="nameHanok">
                                <div class="hanokName">{{$value->hanok_name}}</div>
                                <div class="reviewBox">{{$value->hanok_addr}}</div>
                            </div>
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