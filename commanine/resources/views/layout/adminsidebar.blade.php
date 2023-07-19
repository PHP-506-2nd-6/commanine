<head>
    <link rel="stylesheet" href="{{asset('css/adminSidebar.css')}}">

</head>
<div class="sidebar col-2">
    <ul>
        {{-- <li class="list reserveList"><a  href="{{route('admin.reservation')}}">예약 정보</a></li>
        <li class="list reviewList"><a href="{{route('admin.review')}}">리뷰 관리</a></li> --}}
        <li class="list userList"><a  href="{{route('admin.users')}}">유저 정보</a></li>
        <li class="list hanokList"><a href="{{route('admin.hanoks')}}">숙소 정보</a></li>
    </ul>
</div>