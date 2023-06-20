 /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : public/js
 * 파일명     : regist.js
 * 이력       : 0614 KMH new
 * *********************************** */ 
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


const certification = ()=>{
    const email = document.getElementById('email');
    const url = "/api/users/regist/"+email.value;
    const regex = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
    if (email.value === '') { 
        idSpan.innerHTML = "아이디를 입력해 주세요.";
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
// todo : 쓰로틀 수정 필요, 달력, 또 뭐 해야하나..? 고민좀
const throttle = () =>{
    let timer;
    return() => {
        if (!timer){
            timer = setTimeout(()=>{
                timer = null;
            },1000); 
            certification(); 
        }
    }
}

emailBtn.addEventListener('click',throttle(certification));
//이메일 확인하기 버튼을 누르지 않고 회원가입을 누를 경우 
registBtn.addEventListener('click', function(event) {
    if (btnChk !== true) {
      event.preventDefault(); // 기본 동작 중지
      idSpan.innerHTML = "사용 가능한 아이디인지 확인해 주세요.";
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