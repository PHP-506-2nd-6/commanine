$(function () {
    $(".datepicker").datepicker({ minDate: 0 });
});
$(function () {
    $(".datepicker2").datepicker({ minDate: 0 });
});

$(function () {
    //input을 datepicker로 선언
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd", //달력 날짜 형태
        showOtherMonths: true, //빈 공간에 현재월의 앞뒤월의 날짜를 표시
        showMonthAfterYear: true, // 월- 년 순서가아닌 년도 - 월 순서
        changeYear: true, //option값 년 선택 가능
        changeMonth: true, //option값  월 선택 가능
        showOn: "both", //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시
        // ,buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" //버튼 이미지 경로
        //,buttonImageOnly: true //버튼 이미지만 깔끔하게 보이게함
        buttonText: "선택", //버튼 호버 텍스트
        yearSuffix: "년", //달력의 년도 부분 뒤 텍스트
        monthNamesShort: [
            "1월",
            "2월",
            "3월",
            "4월",
            "5월",
            "6월",
            "7월",
            "8월",
            "9월",
            "10월",
            "11월",
            "12월",
        ], //달력의 월 부분 텍스트
        monthNames: [
            "1월",
            "2월",
            "3월",
            "4월",
            "5월",
            "6월",
            "7월",
            "8월",
            "9월",
            "10월",
            "11월",
            "12월",
        ], //달력의 월 부분 Tooltip
        dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"], //달력의 요일 텍스트
        dayNames: [
            "일요일",
            "월요일",
            "화요일",
            "수요일",
            "목요일",
            "금요일",
            "토요일",
        ], //달력의 요일 Tooltip
        minDate: "-5Y", //최소 선택일자(-1D:하루전, -1M:한달전, -1Y:일년전)
        maxDate: "+5y", //최대 선택일자(+1D:하루후, -1M:한달후, -1Y:일년후)
    });
    //초기값을 오늘 날짜로 설정해줘야 합니다.
    // $('.datepicker').datepicker('setDate', 'today'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
});

$(function () {
    //input을 datepicker로 선언
    $(".datepicker2").datepicker({
        dateFormat: "yy-mm-dd", //달력 날짜 형태
        showOtherMonths: true, //빈 공간에 현재월의 앞뒤월의 날짜를 표시
        showMonthAfterYear: true, // 월- 년 순서가아닌 년도 - 월 순서
        changeYear: true, //option값 년 선택 가능
        changeMonth: true, //option값  월 선택 가능
        showOn: "both", //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시
        // ,buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" //버튼 이미지 경로
        //,buttonImageOnly: true //버튼 이미지만 깔끔하게 보이게함
        buttonText: "선택", //버튼 호버 텍스트
        yearSuffix: "년", //달력의 년도 부분 뒤 텍스트
        monthNamesShort: [
            "1월",
            "2월",
            "3월",
            "4월",
            "5월",
            "6월",
            "7월",
            "8월",
            "9월",
            "10월",
            "11월",
            "12월",
        ], //달력의 월 부분 텍스트
        monthNames: [
            "1월",
            "2월",
            "3월",
            "4월",
            "5월",
            "6월",
            "7월",
            "8월",
            "9월",
            "10월",
            "11월",
            "12월",
        ], //달력의 월 부분 Tooltip
        dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"], //달력의 요일 텍스트
        dayNames: [
            "일요일",
            "월요일",
            "화요일",
            "수요일",
            "목요일",
            "금요일",
            "토요일",
        ], //달력의 요일 Tooltip
        minDate: "-5Y", //최소 선택일자(-1D:하루전, -1M:한달전, -1Y:일년전)
        maxDate: "+5y", //최대 선택일자(+1D:하루후, -1M:한달후, -1Y:일년후)
    });
    //초기값을 오늘 날짜로 설정해줘야 합니다.
    // $(".datepicker").datepicker("setDate", "today"); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
});

function count(type) {
    // 결과를 표시할 element
    const resultElement = document.getElementById("result");

    // 현재 화면에 표시된 값
    let number = resultElement.innerText;

    // 더하기/빼기
    if (type === "plus") {
        number = parseInt(number) + 1;
    } else if (type === "minus") {
        number = parseInt(number) - 1;
    }

    // 결과 출력
    resultElement.innerText = number;
}

$(document).ready(function () {
    var proQty = $(".pro-qty"); // HTML class 이름을 proQty 변수로 저장시킵니다.
    proQty.prepend('<div class="dec qtybtn">-</div>'); // pro-qty 클래스 뒤에 - 버튼
    proQty.append('<div class="inc qtybtn">+</div>'); // pro-qty 클래스 앞에 + 버튼
    proQty.on("click", ".qtybtn", function () {
        // qtybtn 클래스 가 있는 부분을 클릭했을 때 동작합니다.
        var $button = $(this); // 현재 있는 qtybtn의 속성 을 저장합니다.
        var oldValue = $button.parent().find("input").val();
        // qtybtn 의 부모중 input 태그의 value 값을 저장합니다.
        if ($button.hasClass("inc")) {
            // inc 속성을 가지고 있는 경우
            if (oldValue > 10) {
                // 10일 경우 더이상 증가하지 않고 리턴
                return;
            }
            var newVal = parseFloat(oldValue) + 1; // 문자형태인 oldValue를 실수로 변경하고 1을 더한 후 저장합니다.
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                // 0일 경우 더이상 감소하지 않고 리턴
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
        // input 태그에 newVal값을 저장합니다.
    });
});

// 유효성 검사
// document.getElementById("mainsearch").addEventListener("submit", function () {
//     var isValid = performValidation();

//     if (!isValid) {
//         showAlert("모든 항목을 설정하여 주세요");
//     }
// });

// document
//     .getElementById("mainsearch")
//     .addEventListener("submit", function (event) {
//         event.preventDefault(); // 폼의 기본 제출 동작 중단

//         var isValid = performValidation();

//         if (!isValid) {
//             showAlert("모든 항목을 설정하여 주세요");
//         } else {
//             // 유효성 검사 통과한 경우 폼 제출
//             this.submit();
//         }
//     });

// function performValidation() {
//     var nameField = document.getElementById("hanok_name");
//     if (nameField.value === "") {
//         return false;
//     }

//     // 추가적인 유효성 검사 로직을 구현합니다.

//     return true;
// }

// function showAlert(message) {
//     alert(message);
// }

// var errorBox = document.getElementById("errorBox");
// var errorMessages = document.querySelectorAll('.error-message');

// 에러 메시지가 있는 경우 박스를 보이도록 설정
// if (errorMessages.length > 0) {
//     errorBox.style.display = "block";
// } else {
//     errorBox.style.display = "none";
// }

// function showAlert(message) {
//     alert(message);
// }

// // 버튼 클릭 시 팝업 창 호출
// document.getElementById("mainsearch").addEventListener("click", function () {
//     showAlert("팝업 창에 표시할 메시지");
// });
