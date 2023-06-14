
<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
</head>
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
    {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/hanokImg/hanok1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/hanokImg/hanok1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/hanokImg/hanok1.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> --}}

    <div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="item active">
        <img src="/img/hanokImg/hanok1.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="/img/hanokImg/hanok1.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="/img/hanokImg/hanok1.jpg" alt="New york" style="width:100%;">
      </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
</header>
