

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
        imgElement.setAttribute('width', '120'); // 미리보기 이미지의 너비를 조정하려면 이 부분을 변경하세요.
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

//0727 add KMH
// 주소 가져오기
window.onload = function () {
  document.getElementById("address_kakao").addEventListener("click", function () {
      new daum.Postcode({
        oncomplete: function (data) {
          document.getElementById("address_kakao").value = data.address;
        }
      }).open();
    });
}
var geocoder = new kakao.maps.services.Geocoder();


// 위도 경도 저장
function getAddress(){
  console.log('값가져오기');
    let val = document.getElementById('address_kakao').value;
    let latitude = document.getElementById('latitude');
    let longitude = document.getElementById('longitude');
    // if(!val) {
    //     // window.scrollTo(0,0);
    //     // $err = document.getElementById('err_up').innerHTML = "정보를 입력하세요";
    //     // err_up.style.display = 'block';
    //     // console.log('실패');
    //     return;
    // }

    var callback = function(result, status) {
        if (status === kakao.maps.services.Status.OK) {
            // console.log(result);
            // console.log(result[0]['x']);
            // console.log(result[0]['y']);
            longitude.value = result[0]['x'];
            latitude.value = result[0]['y'];
        }
    };
    geocoder.addressSearch(val, callback);
};
