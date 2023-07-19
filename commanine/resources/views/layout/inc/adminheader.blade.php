
<head>
    {{-- <link rel="stylesheet" href="{{asset('css/adminheader.css')}}"> --}}
</head>
<header>
    @if(!(session()->has('admin_id')))
        <a href="{{route('admin.login')}}">로그인</a>
    @elseif(session()->has('admin_id'))
        <a href="{{route('admin.logout')}}">로그아웃</a>
    @endif
    <div>
        <h1><a href="{{route('admin.users')}}">COMMANINE ADMIN</a></h1>
    </div>
    
</header>