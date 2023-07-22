<head>
    <link rel="stylesheet" href="{{asset('css/adminRegist.css')}}">
</head>
<div class="logo">
            <h1><a href="{{route('admin.login')}}" class="a-link trademark">COMMANINE ADMIN</a></h1>
@if(!(session()->has('admin_id')))
                <a href="{{route('admin.login')}}" class="a-link login">로그인 하러 가기</a>
            @elseif(session()->has('admin_id'))
                <a href="{{route('admin.logout')}}" class="a-link login">로그아웃</a>
@endif
</div>










