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