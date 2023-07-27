
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
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                 <a href="{{route('admin.reservation')}}" class="navbar-brand mx-4 mb-3">
                    <h3><img src="{{asset('img/commanine_favi.png')}}" alt="" style="width: 30px;"> commanine</h3>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
   
</header>


