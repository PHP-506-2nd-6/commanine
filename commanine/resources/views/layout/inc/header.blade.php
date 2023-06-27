
<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<header>

    <div class="header_bg">
        <div class="fix">
            <nav>
                <ul class="d-inline-flex mt-2 mt-md-0 ms-md-auto nav_right">
                    @guest()
                    <li class="nav-a1"><a href="{{route('users.login')}}">로그인</a></li>
                    <li class="nav-a2"><a href="{{route('users.regist')}}">회원가입</a></li>
                    <li class="nav-a3"><a href="#">예약내역</a></li>
                    @endguest

                    @auth()
                    <li class="nav-a1"><a href="{{route('users.logout')}}">로그아웃</a></li>
                    <li class="nav-a2"><a href="{{route('users.information.reserve')}}">마이페이지</a></li>
                    @endauth
                </ul>
            </nav>
            <div class="logo">
                <a href="{{route('main')}}"><img src="{{asset('/img/logologo.png')}}" alt="#"></a>
            </div>
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
                                <input name="chkIn" type="text" class="datepicker" autocomplete="off">
                                <label for="chk_out">체크아웃</label>
                                <input name="chkOut" type="text" class="datepicker2" autocomplete="off">
                            </div>
                                {{-- <div class="countWrap">
                        <label for="countP">인원</label>
                        <input type="text" class="countInput" id="countP"/> --}}
                        {{-- <div class="countBox poAbsolute">
                            <div class="adultsBox">
                                <label for="adults">성인</label>
                                <div >
                                    <button class="minBtn" type="button">-</button>
                                    <input type="number" value="2" class="adultsVal" id="adults" min="0" max="99">
                                    <button class="plusBtn" type="button">+</button>
                                </div>
                            </div>
                            <div class="kidsBox">
                                <label for="kids">어린이</label>
                                <div>
                                    <button class="minBtn" type="button">-</button>
                                    <input type="number" value="0" class="kidsVal" id="kids" min="0" max="99">
                                    <button class="plusBtn" type="button">+</button>
                                </div>
                            </div>
                            <button type="button" class="countChkBtn">확인</button>
                        </div> --}}

                            <div class="pro-qty row" style="margin: 0 5px">
                            {{-- <label for="adults">성인</label> --}}
                                <input type="number" name="adults" value="0" readonly="readonly">
                            </div>
                            <div class="pro-qty row" style="margin: 0 5px">
                            {{-- <label for="kids">어린이</label> --}}
                                <input type="number" name="kids" value="0" readonly="readonly">
                            </div>


                            <button id="mainsearch" type="submit">검색</button>
                            
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
