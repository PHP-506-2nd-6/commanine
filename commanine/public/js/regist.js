const emailBtn = document.getElementById('emailBtn');
const email = document.getElementById('email');
const url = "/api/users?email="+email.value;
emailBtn.addEventListener('onclick',certification());
function certification(){
        // API
        
        // fetch(url)
        // .then(data=>{
        //     // Response Status 확인  (200번 외에는 에러 처리)
        //     if(data.status !== 200){
        //         throw new Error(data.status + ' : API Response Error');
        //     }
        //     return data.json();
        // })
        // .then(apiData =>{
        //     if(apiData["flg"] === "1"){
        //         idSpan.innerHTML = apiData["msg"];
        //         idSpan.style.color = "red";
        //     }else if(apiData["flg"] === "2"){
        //         idSpan.innerHTML = apiData["msg"];
        //         idSpan.style.color = "red";
        //     }else{
        //         idSpan.innerHTML = apiData["msg"];
        //         idSpan.style.color = "green";
        //     }
        // })
        // .catch(error=>alert(error.message));
}
