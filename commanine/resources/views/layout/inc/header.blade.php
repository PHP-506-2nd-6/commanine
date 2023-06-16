
<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<header>

    <div class="header_bg">
        <div class="fix">
            <nav class="clearfix">
                <ul class="d-inline-flex mt-2 mt-md-0 ms-md-auto nav_right">
                    <li class="nav-a1"><a href="{{route('users.login')}}">로그인</a></li>
                    <li class="nav-a2"><a href="{{route('users.regist')}}">회원가입</a></li>
                    <li class="nav-a3"><a href="#">예약내역</a></li>
                </ul>
            </nav>
            <div class="logo">
                <a href="#"><img src="{{asset('/img/logo.png')}}" alt="#"></a>
            </div>

            <input id="modalToggle" class="hide" type="checkbox">
            <div class="modal">
                <label class="btn btn-open" for="modalToggle">어디로 떠날까요?</label>
                <div class="inside">
                    <label class="btn-close" for="modalToggle">X</label>
                    <form method="get" action="{{route('research.page')}}" >
                        <div class="search">
                            <div class="search_form1">
                                <label for="hanok_name">스테이/여행지</label>
                                <input type="text" name="hanok_name" id="hanok_name"  placeholder="스테이/여행지">
                                <label for="chk_in">체크인</label>
                                <p>체크인<input type="text" id="datepicker"><input type="text" id="datepicker"></p>
                                <label for="chk_out">체크아웃</label>
                                <input type="text" name="chk_out" id="chk_out"  placeholder="체크아웃">
                            </div>
                            {{-- <div class="search_form2">
                            </div>
                            <div class="search_form3">
                            </div> --}}
                            <button type="submit">검색</button>
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
