
<head>
    {{-- <link rel="stylesheet" href="{{asset('css/adminheader.css')}}"> --}}
</head>
<header>
    {{-- <div class="header-box d-flex justify-content-between ">
        <div class="logo" style="padding: 10px 0">
            <h1><a href="{{route('admin.reservation')}}" class="a-link">COMMANINE ADMIN</a></h1>
        </div>
        <div class="login">
            @if(!(session()->has('admin_id')))
                <a href="{{route('admin.login')}}" class="a-link">로그인</a>
            @elseif(session()->has('admin_id'))
                안녕하세요! <strong>{{session('admin_id')}}</strong> 님 <a href="{{route('admin.logout')}}" class="a-link">로그아웃</a>
            @endif
        </div>
    </div> --}}
     <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light fixed-top px-4 py-0">
                <a href="{{route('admin.reservation')}}" class="navbar-brand">
                    <h3><img src="{{asset('img/commanine_favi.png')}}" alt="" class="logo"> commanine</h3>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <strong>{{session('admin_id')}}</strong> 님 <button type="button" class="logout" onClick="location.href='{{route('admin.logout')}}'">로그아웃</button>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
   
</header>


