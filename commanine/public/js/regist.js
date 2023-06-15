const emailBtn = document.getElementById('emailChkBtn');
const idSpan = document.getElementById('errMsgId');
let apiData = null;
// emailBtn.addEventListener('onclick', certification);
function certification(){
        const email = document.getElementById('email');
        const url = "/api/users/regist/"+email.value;

        
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
            }else if(apiData["errorcode"] === "E02"){
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "red";
            }else{
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "green";
            }
        })
        .catch(error=>alert(error.message));
}







// 쓰로틀
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
emailBtn.addEventListener('onclick',throttle(certification));