
function checkSelectAll()  {

    // 전체 체크박스
    const checkboxes 
    = document.querySelectorAll('input[name="animal"]');
    // 선택된 체크박스
    const checked 
    = document.querySelectorAll('input[name="animal"]:checked');
    // select all 체크박스
    const selectAll 
    = document.querySelector('input[name="selectall"]');
    
    if(checkboxes.length === checked.length)  {
    selectAll.checked = true;
    }else {
    selectAll.checked = false;
    }
    
    }
    
    function selectAll(selectAll)  {
    const checkboxes 
    = document.getElementsByName('animal');
    
    checkboxes.forEach((checkbox) => {
    checkbox.checked = selectAll.checked
    })
}


const nameInput = document.querySelector("#reserve_name");
const reserveName = document.getElementById("reserve_name_inner");
const numInput = document.querySelector("#reserve_num");
const reserveNameNum = document.getElementById("reserve_num_inner");
function reserve_name() {
    if(nameInput.value === "") {
        reserveName.innerText = '성명을 입력해주세요';
    } else {
        reserveName.innerText = '';
    }
}
function reserveNumName() {
    if(numInput.value === "") {
        reserveNameNum.innerText = '전화번호를 입력해주세요';
    } else {
        reserveNameNum.innerText = '';
    }
}

nameInput.addEventListener('blur',reserve_name);
numInput.addEventListener('blur',reserveNumName);