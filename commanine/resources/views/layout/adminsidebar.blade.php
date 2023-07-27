
{{-- <div class="text-center col-3 sidebar" style="width:15%;">
    <ul>
        <li><a  href="{{route('admin.reservation')}}" class="a-link">예약 정보</a></li>
        <li><a href="{{route('admin.review')}}" class="a-link">리뷰 관리</a></li>
        <li><a  href="{{route('admin.users')}}" class="a-link">유저 정보</a></li>
        <li><a href="{{route('admin.hanoks')}}" class="a-link">숙소 정보</a></li>
    </ul>
</div> --}}


 <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" style="width:15%;">
            <nav class="navbar bg-light navbar-light">
                <a href="{{route('admin.reservation')}}" class="navbar-brand mx-4 mb-3">
                    <h3><img src="{{asset('img/commanine_favi.png')}}" alt="" class="logo"> commanine</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('admin.reservation')}}" class="nav-item nav-link"><i class="fa fa-calendar me-2"></i>예약정보</a>
                    <a href="{{route('admin.review')}}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>리뷰관리</a>
                    <a href="{{route('admin.users')}}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>유저정보</a>
                    <a href="{{route('admin.hanoks')}}" class="nav-item nav-link"><i class="fa fa-building me-2"></i>숙소 정보</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->