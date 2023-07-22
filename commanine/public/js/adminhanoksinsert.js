function readURL(input) {
    if (input.files && input.files.length > 0) {
    document.getElementById('imageContainer').innerHTML = '';
    console.log((input.files));
      
        for (let i = 0; i < input.files.length; i++) {
        // 객체 생성
        const reader = new FileReader();
    
        // onload = onchange 할때 onload 발생
        reader.onload = function (e) {
          // <img> 생성
        const imgElement = document.createElement('img');
        // 데이터 url을 src에 저장
        imgElement.setAttribute('src', e.target.result);
        imgElement.setAttribute('width', '150'); // 미리보기 이미지의 너비를 조정하려면 이 부분을 변경하세요.
        imgElement.setAttribute('height', '100'); // 미리보기 이미지의 높이를 조정하려면 이 부분을 변경하세요.
        
          // img 컨테이너 안에 맨끝에 계속 추가
        document.getElementById('imageContainer').appendChild(imgElement);
        };
        
        // 파일 읽기
        reader.readAsDataURL(input.files[i]);
        }
    } else {
      document.getElementById('imageContainer').innerHTML = '';
    }
}