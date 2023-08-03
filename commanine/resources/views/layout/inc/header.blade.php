
<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/> --}}
</head>
<header>

    <div class="header_bg">
        <div class="fix">
            <nav>
                {{-- <div class="menu_hanok"> --}}
                    <a class="menu_hanok" href="{{route('intro')}}">Hanok</a>
                {{-- </div> --}}
                <ul class="menu hidden-button">
                    <li class="menuactive hidden-button"><a href="#menu1">category</a></li>
                    <li><a href="#menu2">popularity</a></li>
                    <li><a href="#menu3">ranking</a></li>
                </ul>
                <div class="logo">
                    <a href="{{route('main')}}"><img src="{{asset('/img/logologo.png')}}" alt="#"></a>
                </div>
                <ul class="d-inline-flex mt-2 mt-md-0 ms-md-auto menu2">
                    @guest()
                    <li class="nav-1"><a href="{{route('users.login')}}">로그인</a></li>
                    <li class="nav-2"><a href="{{route('users.regist')}}">회원가입</a></li>
                    @endguest

                    @if( session('flg') )
                    {{-- @auth() --}}
                    {{-- <li class="nav-1"><a href="{{route('users.logout')}}">로그인</a></li> --}}
                    {{-- @endauth --}}
                    @else
                    {{-- <li class="nav-2"><a href="{{route('users.information.reserve')}}">마이페이지</a></li> --}}

                    <p class="nav-3">안녕하세요! <span class="user_name">{{session('user_name') }}</span>님</p>
                    <li class="nav-1"><a href="{{route('users.logout')}}">로그아웃</a></li>
                    <li class="nav-2"><a href="{{route('users.information.reserve')}}">마이페이지</a></li>
                        
                    @endif

                    {{-- @auth('admins')
                    <p class="nav-3">안녕하세요! <span class="user_name">{{session('user_name') }}</span>님</p>
                    <li class="nav-1"><a href="{{route('users.logout')}}">로그아웃</a></li>
                    <li class="nav-2"><a href="{{route('users.information.reserve')}}">마이페이지</a></li>
                    @endauth --}}
                </ul>
            </nav>
            {{-- 햄버거메뉴 --}}
            <div class="mobile-bar">
                <div class="bar-btn">
                    <span class="bar1"></span>
                    <span class="bar2"></span>
                    <span class="bar3"></span>
                </div>
                <div class="bar-slide">
                    <ul class="slide-menu">
                        @guest()
                        <li><a href="{{route('main')}}">HOME</a></li>
                        <li class="nav-a1"><a href="{{route('users.login')}}">로그인</a></li>
                        <li class="nav-a2"><a href="{{route('users.regist')}}">회원가입</a></li>
                        {{-- <li class="nav-a3"><a href="">예약내역</a></li> --}}
                        @endguest
    
                        @auth()
                        {{-- <p class="hiuser" style="color:#333; margin:7px 30px 0 0;">안녕하세요! <span class="user_name">{{session('user_name') }}</span>님</p> --}}
                        <p class="hiuser">안녕하세요! <span class="user_name">{{session('user_name') }}</span>님</p>
                        <li><a href="{{route('main')}}">HOME</a></li>
                        <li class="nav-a1"><a href="{{route('users.logout')}}">로그아웃</a></li>
                        <li class="nav-a2"><a href="{{route('users.information.reserve')}}">마이페이지</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <input id="modalToggle" class="hide" type="checkbox">
            <div class="modal_search">
                <div class="mobile-modal">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        어디로 떠날까요?
                    </button>
                </div>
                <label class="btn_search btn-open" for="modalToggle">어디로 떠날까요?</label>
                <div class="inside" id="errorBox">
                    <label class="btn-close" for="modalToggle">X</label>
                    @if (session('errormsg'))
                        <script>
                            function showAlert(message) {
                                alert(message);
                            }
                            window.addEventListener('DOMContentLoaded', function() {
                                showAlert("모든 항목은 필수 사항입니다.");
                            });
                        </script>
                    @endif

                    <form method="get" action="{{route('research.page')}}" >
                        <div class="search_form">
                            <div class="search_form1">
                                <label for="hanok_name">스테이/여행지</label>
                                <input type="text" name="locOrHan" id="hanok_name"  placeholder="스테이/여행지" autocomplete="off">
                            </div>
                            <div class="search_form2">
                                <label for="chk_in">체크인</label>
                                <input name="chkIn" type="text" class="datepicker" placeholder="가는 날짜" autocomplete="off" readonly>
                                <label for="chk_out">체크아웃</label>
                                <input name="chkOut" type="text" class="datepicker2" placeholder="오는 날짜" autocomplete="off" readonly>
                            </div>
                            <div class="headercountBox poAbsolute">
                                <div class="header_adults">
                                    <label for="adults">성인</label>
                                    <div class="pro-qty row" style="margin: 0 2px">
                                        <input type="number" name="adults" value="2" readonly="readonly">
                                    </div>
                                </div>
                                <div class="header_kids">
                                    <label for="kids">어린이</label>
                                    <div class="pro-qty row" style="margin: 0 2px">
                                        <input type="number" name="kids" value="0" readonly="readonly">
                                    </div> 
                                </div>
                            </div>
                            <button id="mainsearch" class="main_btn" type="submit">검색</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    {{-- 모바일 모달 --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <form method="get" action="{{route('research.page')}}" >
                            <div class="search_form mo-search">
                                <div class="search_form1">
                                    <label for="hanok_name">스테이/여행지</label>
                                    <input type="text" name="locOrHan" id="hanok_name"  placeholder="스테이/여행지" autocomplete="off">
                                </div>
                                <div class="search_form2">
                                    <label for="chk_in">체크인</label>
                                    <input name="chkIn" type="text" class="datepicker" placeholder="가는 날짜" autocomplete="off" readonly>
                                    <label for="chk_out">체크아웃</label>
                                    <input name="chkOut" type="text" class="datepicker2" placeholder="오는 날짜" autocomplete="off" readonly>
                                </div>
                                <div class="headercountBox poAbsolute">
                                    <div class="header_adults">
                                        <label for="adults">성인</label>
                                        <div class="pro-qty row" style="margin: 0 2px">
                                            <input type="number" name="adults" value="2" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="header_kids">
                                        <label for="kids">어린이</label>
                                        <div class="pro-qty row" style="margin: 0 2px">
                                            <input type="number" name="kids" value="0" readonly="readonly">
                                        </div> 
                                    </div>
                                </div>
                                <button id="mainsearch" class="main_btn" type="submit">검색</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</header>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{asset('js/header.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>