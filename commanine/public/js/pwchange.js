 // 다른 페이지 a태그 클릭하여 이동 시 이동 막고 alert
$(document).ready(function(){
    $("a").on("click",function(event){ // a태그 클릭시 작동
    // 클릭된 태그의 본래의 기능을 막음 즉, a태그 본래 기능을 막음
    event.preventDefault();
    alert("임시 비밀번호를 변경해주세요.");
    });
});


const password = document.getElementById('password');
const passwordChk = document.getElementById('passwordChk');
const pwAlert = document.getElementById('pwAlert');
const pwChkAlert = document.getElementById('pwChkAlert');

const submitBtn = document.getElementById('submitBtn');
let btnChk = true;

password.addEventListener('blur', checkPw);
passwordChk.addEventListener('input', checkPasswordMatch);

function checkPw(){
    const pwRegex = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u;
    
    if(pwRegex.test(password.value) === true){
        pwAlert.innerHTML = '사용 가능한 비밀번호입니다.';
        pwAlert.style.color = 'green';
    }
    else{
        pwAlert.innerHTML = '영어, 숫자, 특수문자 포함 8~20자로 입력해 주세요.';
        pwAlert.style.color = 'red';
    }
};

function checkPasswordMatch() {
    // 비밀번호와 비밀번호 확인이 일치한 경우
    if (password.value === passwordChk.value) {
    pwChkAlert.innerHTML = '비밀번호와 일치합니다.';
    pwChkAlert.style.color = 'green';
    // 비밀번호와 비밀번호 확인이 일치하지 않은 경우
    } else {
    pwChkAlert.innerHTML = '비밀번호와 일치하지 않습니다.';
    pwChkAlert.style.color = 'red';
    }
};

submitBtn.addEventListener('click', function(event) {
    if (btnChk !== true) {
      event.preventDefault(); // 기본 동작 중지
    }
});