
<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
</head>
<header>

    <div class="header_bg">
        <div class="fix">
            <nav class="clearfix">
                {{-- <ul class="nav-left">
                    <li>
                        <a href="#"><i class="far fa-bookmark"></i> BOOKMARK</a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-instagram"></i> INSTA</a>
                    </li>
                </ul> --}}

                <ul class="d-inline-flex mt-2 mt-md-0 ms-md-auto nav_right">
                    <li class="nav-a1"><a href="#">로그인</a></li>
                    <li class="nav-a2"><a href="#">회원가입</a></li>
                    <li class="nav-a3"><a href="#">예약내역</a></li>
                </ul>
            </nav>
            <div class="logo">
                <img src="{{asset('/img/logo.png')}}" alt="#">
            </div>

            <input id="modalToggle" class="hide" type="checkbox">
            <div class="modal">
                <label class="btn btn-open" for="modalToggle">어디로 떠날까요?</label>
                <div class="inside">
                    <label class="btn-close" for="modalToggle">X</label>
                    <div class="search">
                        <ul class="search_form">
                            <li>여행지</li>
                            <li>체크인</li>
                            <li>체크아웃</li>
                            <li>인원</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    
    </div>
</header>
