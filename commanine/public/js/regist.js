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


const certification = ()=>{
    const email = document.getElementById('email');
    const url = "/api/users/regist/"+email.value;
    const regex = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
    if (email.value === '') { 
        idSpan.innerHTML = "이메일을 입력해 주세요.";
        idSpan.style.color = "red";
        return;
    }
    if(regex.test(email.value) === false){
        idSpan.innerHTML = "이메일 형식으로 입력해 주세요.";
        idSpan.style.color = "red";
        return;
    }

        fetch(url)
        .then(data=>{
        //     // Response Status 확인  (200번 외에는 에러 처리)
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
        .then(apiData =>{
            if(apiData["errorcode"] === "E01"){
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "red";
            }else{
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "green";
                btnChk = true;
            }
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
//이메일 확인하기 버튼을 누르지 않고 회원가입을 누를 경우 
registBtn.addEventListener('click', function(event) {
    if (btnChk !== true) {
      event.preventDefault(); // 기본 동작 중지
    idSpan.innerHTML = "사용 가능한 이메일인지 확인해 주세요.";
    idSpan.style.color = "red";
    }
});

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
    
    if(emailRegex.test(emailInput.value) === true){
        emailAlert.innerHTML = '이메일 중복확인을 해주세요.';
        emailAlert.style.color = 'red';
    }
    else{
        emailAlert.innerHTML = '이메일 형식에 맞게 입력해 주세요.';
        emailAlert.style.color = 'red';
    }
}

function checkEmail(){
    const emailInput = document.querySelector('.emailInput');
    const emailAlert = document.querySelector('.emailAlert');
    const emailRegex = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
    
    if(emailRegex.test(emailInput.value) === true){
        emailAlert.innerHTML = '이메일 중복확인을 해주세요.';
        emailAlert.style.color = 'red';
    }
    else{
        emailAlert.innerHTML = '이메일 형식에 맞게 입력해 주세요.';
        emailAlert.style.color = 'red';
    }
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
