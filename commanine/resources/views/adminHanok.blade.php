@extends('layout.adminlayout')

@section('contents')

    @include('layout.adminsidebar')
    <h2>숙소관리</h2>
    <form action="{{route('admin.hanoks.search')}}" method="get">
        <input type="text" placeholder="숙소명 / 주소 입력" name="hanoks">
        <button type="submit">검색</button>
    </form>
    <button onclick="location.href='{{route('admin.hanoks.insert')}}'">숙소 등록</button>
    <div class="searchUl">
        @forelse($hanoks as $value)
            <div class="searchList">
                {{-- <a href="{{route('hanoks.detail',$value->id)}}" class="listA"> --}}
                <a href="{{route('admin.hanoks.detail',[ 'hanok_id' => $value->id ])}}" class="listA">
                    <div class="imgBox">
                        <img src="{{asset($value->hanok_img1)}}" >
                    </div>
                    <div class="explainHanok">
                        <div class="nameHanok">
                        {{-- 숙소명 --}}
                            <div class="hanokName">{{$value->hanok_name}}</div>
                        {{-- </div>
                        <div class="reviewHanok"> --}}
                            {{-- <span><img src="{{asset('img/icon/star.png')}}" alt="star" class="star"></span> --}}
                        {{-- 별점 평균 --}}
                            <div class="reviewBox">{{$value->hanok_addr}}</div>
                        {{-- 리뷰 개수 --}}
                            {{-- <span>({{$value->cnt}})</span> --}}
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
@endsection