
<header>
    <div class="header_bg">
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
        <div class="clearfix nav-form">
            <form action="search"><i class="fas fa-search "></i>
                <input type="text" placeholder="어디로 떠날까요?">
            </form>
        </div>
        {{-- <div class="search-wrapper">
            <div class="input-holder">
                <input type="text" class="search-input" placeholder="Type to search" />
                <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
            </div>
            <span class="close" onclick="searchToggle(this, event);"></span>
        </div> --}}

    </div>
    <input id="modalToggle" class="hide" type="checkbox">
        <div class="modal">
            <label class="btn btn-open" for="modalToggle">Open modal</label>
            <div class="inside">
                <label class="btn-close" for="modalToggle">X</label>
                <p>Text goes here.</p>
            </div>
        </div>
    
</header>
