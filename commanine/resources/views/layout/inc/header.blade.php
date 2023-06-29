
<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<header>

    <div class="header_bg">
        <div class="fix">
            <nav>
                <ol class="menu">
                    <li class="menuactive"><a href="#menu1">category</a></li>
                    <li><a href="#menu2">popularity</a></li>
                    <li><a href="#menu3">recent</a></li>
                </ol>
                <div class="logo">
                    <a href="{{route('main')}}"><img src="{{asset('/img/logologo.png')}}" alt="#"></a>
                </div>
                <ul class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    @guest()
                    <li class="nav-a1"><a href="{{route('users.login')}}">로그인</a></li>
                    <li class="nav-a2"><a href="{{route('users.regist')}}">회원가입</a></li>
                    {{-- <li class="nav-a3"><a href="">예약내역</a></li> --}}
                    @endguest

                    @auth()
                    <p style="color:#333; margin:7px 30px 0 0;">안녕하세요! <strong>{{session('user_name') }}</strong>님</p>
                    <li class="nav-a1"><a href="{{route('users.logout')}}">로그아웃</a></li>
                    <li class="nav-a2"><a href="{{route('users.information.reserve')}}">마이페이지</a></li>
                    @endauth
                </ul>
            </nav>
            <input id="modalToggle" class="hide" type="checkbox">
            <div class="modal_search">
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
</header>
    
<script src="{{asset('js/header.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
