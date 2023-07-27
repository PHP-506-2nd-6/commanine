/* *************************************
    * 프로젝트명 : commanine
    * 디렉토리   : public/js
    * 파일명     : adminhanokupdate.js
    * 이력       : 0723 v001 KMH new
    * *********************************** */ 
    function formatPrice(input) {
        // 콤마 제거하고 숫자만 추출
        let value = input.value.replace(/,/g, '');
        // 정수 형태로 변환
        value = parseInt(value, 10);
        // 콤마 추가하여 다시 문자열로 변환
        value = value.toLocaleString();
        // 입력 필드에 콤마 추가
        input.value = value;
    }



// 이미지 미리 보기를 표시하는 함수
    function preview(event, imgId) {
        const image = document.getElementById(imgId);
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
                image.style.display = 'block'; // 이미지 미리 보기 활성화
            };
            reader.readAsDataURL(event.target.files[0]);
        } else {
            image.src = "#"; // 이미지 미리 보기 비활성화
            image.style.display = 'none';
        }
    }


    // 가격 문자 입력할 경우 ''대체
    function onlyNumber(num) {
        
        const numericValue = num.value.replace(/\D/g, '');
    }


    // 아코디언
        // nextElementSibling => 모두 같은 노드 레벨의 다음 값을 가져옴 
        // nextElementSibling 은 Element(요소)만 가져옴
        function collapse(element) {
            
            let before = document.getElementsByClassName("active")[0];             // 기존에 활성화된 버튼
            if (before && document.getElementsByClassName("active")[0] != element) {  // 자신 이외에 이미 활성화된 버튼이 있으면
                before.nextElementSibling.style.maxHeight = null;   // 기존에 펼쳐진 내용 접고
                before.classList.remove("active");                  // 버튼 비활성화
            }
            element.classList.toggle("active");         // 활성화 여부 toggle

            let content = element.nextElementSibling;
            if (content.style.maxHeight != 0) {         // 버튼 다음 요소가 펼쳐져 있으면
                content.style.maxHeight = null;         // 접기
            } else {
                content.style.maxHeight = content.scrollHeight +  "200px";  // 접혀있는 경우 펼치기
            }
            
            // for(let i = 0; i<collaps.length; i++ ){
            //     if(collaps[i].classList.contains('active')){
            //         contentBox[i].style.border=" 1px solid #000 ; ";
            //         return;
            //     }
            // }
        }

