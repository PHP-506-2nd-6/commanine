 /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : public/js
 * 파일명     : regist.js
 * 이력       : 0614 KMH new
 * *********************************** */ 
// 이름 input, alert
// const nameInput = document.querySelector('.nameInput');
// const nameAlert = document.querySelector('.nameAlert');
// 전화번호 input, alert
// const numInput = document.querySelector('.numInput');
// const numAlert = document.querySelector('.numAlert');
// 이메일 input, alert
// const emailInput = document.querySelector('.emailInput');
// const emailAlert = document.querySelector('.emailAlert');
// 비밀번호 input, alert
// const pwInput = document.querySelector('.pwInput');
// const pwAlert = document.querySelector('.pwAlert');
// 질문의 답 input, alert
// const answerInput = document.querySelector('.answerInput');
// const answerAlert = document.querySelector('.answerAlert');
// EMAIL 체크 변수
const emailBtn = document.getElementById('emailChkBtn');
const idSpan = document.getElementById('errMsgId');
const btnThro = document.querySelector('.btnThro');
const registBtn = document.querySelector('.registBtn');
let btnChk = false; 
let apiData = null;
// EMAIL 체크 변수 end *********************
// 이메일 인증번호 체크 변수
const emailChkNumBtn = document.getElementById('emailChkNumBtn');
const emailChkNum = document.getElementById('emailChkNum');
const errMsgEmailChkNum = document.getElementById('errMsgEmailChkNum');
let numChk = false;
const timet = document.getElementById('timet');
// 이메일 인증번호 체크 변수 end ************
// password 체크 변수
const pw = document.getElementById('password');
const pwChk = document.getElementById('passwordChk');
const pwChkAlert = document.getElementById('pwChkAlert');
// password 체크 변수 end *********************

// errbox 
const errmsg = document.querySelectorAll('.errmsg');
const errbox = document.querySelectorAll('.errbox');

//달력 input
const birthInput = document.querySelector('#birth');

// 로딩
const bgWhite = document.querySelector('.bgWhite');
const textCenter = document.querySelector('.text-center');
bgWhite.style.display = 'none';
textCenter.style.display = 'none';

const email = document.getElementById('email');
let certFlg = false;
email.disabled = false;
const certification = ()=>{
    const url = "/api/users/regist/"+email.value;
    const regex = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
    if (email.value === '') { 
        idSpan.innerHTML = "이메일을 입력해 주세요.";
        idSpan.style.color = "red";
        return;
    }
    if(regex.test(email.value) === false){
        idSpan.innerHTML = "이메일 형식에 맞게 입력해 주세요.";
        idSpan.style.color = "red";
        return;
    }
    bgWhite.style.display = 'block';
    textCenter.style.display = 'inline-block';
    emailBtn.innerHTML = "재발송하기";

        fetch(url)
        .then(data=>{
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
        .then(apiData =>{
            if(apiData["errorcode"] === "E01"){
                bgWhite.style.display = 'none';
                textCenter.style.display = 'none';
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "red";
                timet.style.display = 'none'
            }else{
                bgWhite.style.display = 'none';
                textCenter.style.display = 'none';
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "green";
                email.disabled = true;
                emailChkNum.disabled = false;
                emailChkNum.value = "";
                errMsgEmailChkNum.innerHTML = "";
                if (certFlg) {  // 재발송 시에 기존 타이머 clear
                    clearInterval(cntDown);
                }
                certFlg = true;
                // 인증메일 발송 후 타이머 시작
                let time = 600; // 기준시간
                let min = "";
                let sec = "";

                cntDown = setInterval(()=>{
                    min = parseInt(time/60); // 분
                    sec = time%60; // 초
                    if (min < 10) {
                        min = "0" + min;
                    }
                    if (sec < 10) {
                        sec = "0" + sec;
                    }
                    timet.innerHTML = min + ":" + sec;
                    time--;

                    if (time < 0) {
                        clearInterval(cntDown);
                    }

                }, 1000);
            }
                        })
        .catch(error=>alert(error.message));
}

// 인증번호 보내기?

// timet.style.display = 'none'
// timet.innerHTML = "";

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// function storeUserChks(){
//     const url = '/api/users/regist/' + email.value;
//     fetch(url, {
//         headers: {
//             "Content-Type": "application/json",
//             "Accept": "application/json, text-plain, */*",
//             "X-Requested-With": "XMLHttpRequest",
//             "X-CSRF-TOKEN": token
//             },
//         method: 'post',
//         credentials: "same-origin",
//         body: JSON.stringify({
//             email: email.value
//         })
//     })
//     .then((data) => {
//         console.log(data);
//     })
//     .catch((err) => {
//         console.log(err);
//     })
//     emailChkNum.disabled = false;
// }

// 인증번호 체크
function mailNumChk(){
    const url = "/api/users/mail/"+email.value;
    fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                    },
                method: 'PUT',
                // method: 'get',
                credentials: "same-origin",
                body: JSON.stringify({
                    email: email.value
                    ,chk_num: emailChkNum.value
                    // ,chk_flg:"1"
                })
            })
    .then(data=>{
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
    .then(data => {
        if (data["errorcode"] === "E02") {
            errMsgEmailChkNum.innerHTML = data['msg'];
            errMsgEmailChkNum.style.color = "red";
            btnChk = false;
        } else {
            errMsgEmailChkNum.innerHTML = data['msg'];
            errMsgEmailChkNum.style.color = "green";
            btnChk = true;
            emailChkNumBtn.disabled = true;
            emailChkNum.disabled = true;
            clearInterval(cntDown);
        }
        console.log(data);
    })
    .catch(error=>alert(error.message));
}

// 쓰로틀

const throttle = () =>{
    let timer;
    // undefined (false)
    return() => {
        if (!timer){
            timer = setTimeout(()=>{
                timer = null;
            },1000); // 1초뒤에 timer를 null로 바꿔주는 setTimeout 콜백함수를 호출하는걸 timer에 넣어주고
            certification(); // certification()실행  => 1초동안은 timer가 null이 아니기 때문에 실행이 안됨. 
        }
    }
}

// birthInput.addEventListener('click',throttleBirth());
emailBtn.addEventListener('click',throttle(certification));
emailChkNumBtn.addEventListener('click', mailNumChk);

//이메일 확인하기 버튼을 누르지 않고 회원가입을 누를 경우 
registBtn.addEventListener('click', function(event) {
    if (btnChk !== true) {
      event.preventDefault(); // 기본 동작 중지
    // idSpan.innerHTML = "사용 가능한 이메일인지 확인해 주세요.";
    // idSpan.style.color = "red";
    errMsgEmailChkNum.innerHTML = '이메일을 인증해주세요.';
    errMsgEmailChkNum.style.color = 'red';
    }
});

// ! 이메일 인증번호 유효성 체크
function emailNumChk(){
    const emailNum = emailChkNum.value;
    const numRegex = /^[0-9]{8}$/;
    if(emailNum == ''){
        errMsgEmailChkNum.innerHTML = '인증번호를 입력해주세요.';
        errMsgEmailChkNum.style.color = 'red';
        emailChkNumBtn.disabled = true;
    } else if (numRegex.test(emailNum) === false) {
        errMsgEmailChkNum.innerHTML = '유효한 인증번호가 아닙니다.';
        errMsgEmailChkNum.style.color = 'red';
        emailChkNumBtn.disabled = true;
    } else{
        errMsgEmailChkNum.innerHTML = '';
        emailChkNumBtn.disabled = false;
    }
    // else{
    //     nameAlert.innerHTML = '이름은 한글로 2~30자 입력해 주세요.';
    //     nameAlert.style.color = 'red';
    // }

}

// ! 비밀번호 체크 
const checkPasswordMatch = () => {
    const password = pw.value;
    const chkPassword = pwChk.value;
    // 비밀번호와 비밀번호 확인이 일치한 경우
    if (password === chkPassword) {
    pwChkAlert.innerHTML = '비밀번호와 일치합니다.';
    pwChkAlert.style.color = 'green';
    // 비밀번호와 비밀번호 확인이 일치하지 않은 경우
    } else {
    pwChkAlert.innerHTML = '비밀번호와 일치하지 않습니다..';
    pwChkAlert.style.color = 'red';
    }
};

pwChk.addEventListener('input', checkPasswordMatch);


// 실시간 유효성 체크

// function joinformCheck(){
//     // 이름 input, alert
// const nameInput = document.querySelector('.nameInput');
// const nameAlert = document.querySelector('.nameAlert');
// // 전화번호 input, alert
// const numInput = document.querySelector('.numInput');
// const numAlert = document.querySelector('.numAlert');
// // 이메일 input, alert
// const emailInput = document.querySelector('.emailInput');
// const emailAlert = document.querySelector('.emailAlert');
// // 비밀번호 input, alert
// // const pwInput = document.querySelector('.pwInput');
// const pwAlert = document.querySelector('.pwAlert');
// // 질문의 답 input, alert
// const answerInput = document.querySelector('.answerInput');
// const answerAlert = document.querySelector('.answerAlert');
// // EMAIL 체크 변수
// const emailBtn = document.getElementById('emailChkBtn');
// const idSpan = document.getElementById('errMsgId');
//     const nameRegex = /^[가-힣]{2,30}$/;
//     if(nameInput.vale === ""){
//             nameAlert.innerHTML = '이름을 입력하세요.';
//             nameAlert.style.color = 'red';
//     }else if(nameRegex.test(nameInput) === false){
//         nameAlert.innerHTML = '이름은 한글로 2~30자 입력해 주세요.';
//         nameAlert.style.color = 'red';
//     }else{
//         nameAlert.innerHTML = '사용 가능한 이름입니다.';
//         nameAlert.style.color = 'red';
//     }
// }

function checkName(){
    const nameInput = document.querySelector('.nameInput');
    const nameAlert = document.querySelector('.nameAlert');
    const nameRegex = /^[가-힣]{2,30}$/u;
    
    if(nameRegex.test(nameInput.value) === true){
        nameAlert.innerHTML = '사용 가능한 이름입니다.';
        nameAlert.style.color = 'green';
    }
    else{
        nameAlert.innerHTML = '이름은 한글로 2~30자 입력해 주세요.';
        nameAlert.style.color = 'red';
    }
}

function checkNum(){
    const numInput = document.querySelector('.numInput');
    const numAlert = document.querySelector('.numAlert');
    const numRegex = /^[0-9]{3}[0-9]{4}[0-9]{4}$/u;
    
    if(numRegex.test(numInput.value) === true){
        numAlert.innerHTML = '사용 가능한 전화번호입니다.';
        numAlert.style.color = 'green';
    }
    else{
        numAlert.innerHTML = '전화번호는 숫자로만 입력해 주세요.';
        numAlert.style.color = 'red';
    }
}
function checkPw(){
    const pwInput = document.querySelector('.pwInput');
    const pwAlert = document.querySelector('.pwAlert');
    const pwRegex = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u;
    
    if(pwRegex.test(pwInput.value) === true){
        pwAlert.innerHTML = '사용 가능한 비밀번호입니다.';
        pwAlert.style.color = 'green';
    }
    else{
        pwAlert.innerHTML = '영어, 숫자, 특수문자 포함 8~20 입력해 주세요.';
        pwAlert.style.color = 'red';
    }
}

function checkAnswer(){
    const answerInput = document.querySelector('.answerInput');
    const answerAlert = document.querySelector('.answerAlert');
    const answerRegex = /^[ㄱ-ㅎ가-힣a-zA-Z0-9]{2,30}$/u;
    
    if(answerRegex.test(answerInput.value) === true){
        answerAlert.innerHTML = '사용 가능한 답입니다.';
        answerAlert.style.color = 'green';
    }
    else{
        answerAlert.innerHTML = '한글,영어,숫자로 2~30자 입력해 주세요.';
        answerAlert.style.color = 'red';
    }
}

function checkEmail(){
    const emailInput = document.querySelector('.emailInput');
    const emailAlert = document.querySelector('.emailAlert');
    const emailRegex = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
    
    if(emailRegex.test(emailInput.value) == false){
        emailAlert.innerHTML = '이메일 형식에 맞게 입력해 주세요.';
        emailAlert.style.color = 'red';
    } else {
        emailAlert.innerHTML = "";
    }
    // if(emailRegex.test(emailInput.value) === true){
    //     emailAlert.innerHTML = '이메일 중복확인을 해주세요.';
    //     emailAlert.style.color = 'red';
    // }
    // else{
    //     emailAlert.innerHTML = '이메일 형식에 맞게 입력해 주세요.';
    //     emailAlert.style.color = 'red';
    // }
}

function checkEmailNum(){
    const emailInput = document.querySelector('.emailInput');
    const emailAlert = document.querySelector('.emailAlert');
    const emailRegex = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
    if(emailRegex.test(emailInput.value) == false){
        emailAlert.innerHTML = '이메일 형식에 맞게 입력해 주세요.';
        emailAlert.style.color = 'red';}
    // if(emailRegex.test(emailInput.value) === true){
    //     emailAlert.innerHTML = '이메일 중복확인을 해주세요.';
    //     emailAlert.style.color = 'red';
    // }
    // else{
    //     emailAlert.innerHTML = '이메일 형식에 맞게 입력해 주세요.';
    //     emailAlert.style.color = 'red';
    // }
}

function checkBirth(){
    const birthInput = document.querySelector('.birthInput');
    const birthAlert = document.querySelector('.birthAlert');
    const today = new Date();

    const birthDay = new Date(birthInput.value);

    let age = 0;

    age = today.getFullYear() - birthDay.getFullYear();

    birthDay.setFullYear(today.getFullYear());

    if (today.getTime() < birthDay.getTime()) {
    age--;
    }
    if(age<18){
        birthAlert.innerHTML = '만 18세 이상만 가입이 가능합니다.';
        birthAlert.style.color = 'red';
    }else{
        birthAlert.innerHTML = '가입이 가능한 나이입니다.';
        birthAlert.style.color = 'green';
    }
};

// enter로 submit되는 것 방지
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
    event.preventDefault();
    };
}, true);
