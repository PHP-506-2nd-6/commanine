$(document).ready(function(){
    $("a").on("click",function(event){ // a태그 클릭시 작동
    // 클릭된 태그의 본래의 기능을 막음 즉, a태그 본래 기능을 막음
    event.preventDefault();
    // var txt = $(this).attr("href"); // href에 입력된 값을 가져옴 즉 클릭된 a의 국어, 영어, 수학 중 하나를 가져옴

    alert("임시 비밀번호를 변경해주세요.");
    });
}); // end of ready()