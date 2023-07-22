<head>
    <link rel="stylesheet" href="{{asset('css/adminRegist.css')}}">
</head>
<div class="logo">
    <h1><a href="{{route('admin.login')}}" class="a-link trademark">COMMANINE ADMIN</a></h1>
@if(!(session()->has('admin_id')))
    <a href="{{route('admin.login')}}" class="a-link login">로그인 하러 가기</a>
@elseif(session()->has('admin_id'))
    <ul>
        <li><a  href="{{route('admin.reservation')}}">예약 정보 보기</a></li>
        <li><a href="{{route('admin.review')}}">리뷰 관리 보기</a></li>
        <li><a  href="{{route('admin.users')}}">유저 정보 보기</a></li>
        <li><a href="{{route('admin.hanoks')}}">숙소 정보 보기</a></li>
    </ul>
    <div class="logout">
        <a href="{{route('admin.logout')}}" class="a-link login">로그아웃</a>
    </div>
@endif
</div>










