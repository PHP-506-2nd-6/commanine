
<head>
    {{-- <link rel="stylesheet" href="{{asset('css/adminheader.css')}}"> --}}
</head>
<header>
    <div class="header-box d-flex justify-content-between ">
        <div class="logo" style="padding: 10px 0">
            <h1><a href="{{route('admin.users')}}" class="a-link">COMMANINE ADMIN</a></h1>
        </div>
        <div class="login">
            @if(!(session()->has('admin_id')))
                <a href="{{route('admin.login')}}" class="a-link">로그인</a>
            @elseif(session()->has('admin_id'))
                <a href="{{route('admin.logout')}}" class="a-link">로그아웃</a>
            @endif
        </div>
    </div>
</header>


