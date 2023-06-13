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
    </div>
    {{-- <div class="nav-border">
        <ul class="gnb clearfix">
            <li class="manu bar">
                <a href="#">
                    <div class="nav-btn">
                        <span class="bar1"></span>
                        <span class="bar2"></span>
                        <span class="bar3"></span>
                    </div>
                </a>
            </li>

            <li class="chair">
                <a href="sub-chair.html">
                    <img src="image/chair01.png" alt="chair"></a>
            </li>

            <li class="bed">
                <a href="sub-bed.html">
                    <img src="image/bed01.png" alt="bed"></a>
            </li>

            <li class="table">
                <a href="sub-table.html">
                    <img src="image/table01.png" alt="table"></a>
            </li>

            <li class="tv board">
                <a href="sub-storage.html">
                    <img src="image/tvboard01.png" alt="tv board"></a>
            </li>
            <li class="closet">
                <a href="sub-shelf.html">
                    <img src="image/closet01.png" alt="closet"></a>
            </li>
        </ul>
    </div> --}}
</header>









        {{-- <div class="nav">
            <div class="logo">
                <img src="{{asset('/img/logo.png')}}" alt="#">
            </div>
            <div class="d-inline-flex mt-2 mt-md-0 ms-md-auto nav_list">
                <a class="nav-a1">로그인</a>
                <a class="nav-a2" href="/user/signup">회원가입</a>
                <p class="nav-a3"></p>

                <a class="nav-a6">마이페이지</a>
                <a class="nav-a3" href="#">
                    예약내역
                </a>
            </div>
        </div>
        <div class="search">
        
        </div> --}}


<script>
var picker = new Lightpick({
    field: document.getElementById('demo-5'),
    singleDate: false,
    numberOfColumns: 3,
    numberOfMonths: 6,
    onSelect: function(start, end){
        var str = '';
        str += start ? start.format('Do MMMM YYYY') + ' to ' : '';
        str += end ? end.format('Do MMMM YYYY') : '...';
        document.getElementById('result-5').innerHTML = str;
    }
});
</script>