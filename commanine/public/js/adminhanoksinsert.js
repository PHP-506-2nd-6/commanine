

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

window.onload = function(){
  document.getElementById("address_kakao").addEventListener("click", function(){ //주소입력칸을 클릭하면
      //카카오 지도 발생
      new daum.Postcode({
          oncomplete: function(data) { //선택시 입력값 세팅
              document.getElementById("address_kakao").value = data.address; // 주소 넣기
              document.querySelector("input[name=hanok_num]").focus(); //상세입력 포커싱
          }
      }).open();
  });
}


// let longitude = document.querySelector('#longitude');
// let latitude = document.querySelector('#latitude');
let ad = document.getElementsByClassName('ad');
let latitude = document.getElementById('latitude');
let longtitude = document.getElementById('longtitude');
ad.addEventListener('change',latAndLong());



function latAndLong(){
//   // var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
//   //   mapOption = {
//   //       center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
//   //       level: 3 // 지도의 확대 레벨
//   //   };  
//   // console.log(kakao);


		
 var geocoder = new kakao.maps.services.Geocoder();
 geocoder.addressSearch(document.getElementById("address_kakao").value, function(result, status) {
    if (status === kakao.maps.services.Status.OK) {
      console.log('성공');
    // var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
    latitude.value = new kakao.maps.LatLng(result[0].x);
    longitude.value = new kakao.maps.LatLng(result[0].y);
    }else{
      console.log('실패;')
    }
  });
}
// }

// var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
//     mapOption = {
//         center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
//         level: 3 // 지도의 확대 레벨
    // };  

// // 지도를 생성합니다    
// var map = new kakao.maps.Map(mapContainer, mapOption); 

// // 주소-좌표 변환 객체를 생성합니다
// var geocoder = new kakao.maps.services.Geocoder();

// // 주소로 좌표를 검색합니다
// geocoder.addressSearch(ad.value, function(result, status) {

//     // 정상적으로 검색이 완료됐으면 
//      if (status === kakao.maps.services.Status.OK) {

//         var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
// 		var message = 'latlng: new kakao.maps.LatLng(' + result[0].y + ', ';
// 		message += result[0].x + ')';
		
// 		var resultDiv = document.getElementById('clickLatlng'); 
// 		resultDiv.innerHTML = message;
		
//         // 결과값으로 받은 위치를 마커로 표시합니다
//         // var marker = new kakao.maps.Marker({
//         //     map: map,
//         //     position: coords
//         // });

//         // 인포윈도우로 장소에 대한 설명을 표시합니다
//         // var infowindow = new kakao.maps.InfoWindow({
//         //     content: '<div style="width:150px;text-align:center;padding:6px 0;">장소</div>'
//         // });
//         // infowindow.open(map, marker);

//         // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
//         // map.setCenter(coords);
//     } 
// });    