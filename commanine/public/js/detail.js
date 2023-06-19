/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : public/js
 * 파일명     : detail.js
 * 이력       : 0615 KMJ new
 * *********************************** */ 
const tabs = document.querySelectorAll('.tabBtn');
const contents = document.querySelectorAll('.content');
// 탭 메뉴
tabs.forEach((tab, index)=>{
    tab.addEventListener('click', (e)=> {
        tabs.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');
        // 탭 메뉴 밑줄
        let line = document.querySelector('.line');
        line.style.width = e.target.offsetWidth + "px";
        line.style.left = e.target.offsetLeft + "px";
        // 탭 누르면 해당 콘텐츠 보이기
        contents.forEach(content=>{content.classList.remove('active')});
        contents[index].classList.add('active');
        map.relayout();
        map.setCenter(new kakao.maps.LatLng(37.823954277354865, 127.44406812794968));
    })
})

var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(37.823954277354865, 127.44406812794968), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

var imageSrc = "http://localhost/img/map_pin.png", // 마커이미지의 주소입니다    
    imageSize = new kakao.maps.Size(36, 36), // 마커이미지의 크기입니다
    imageOption = {offset: new kakao.maps.Point(18, 36)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
    markerPosition = new kakao.maps.LatLng(37.823954277354865, 127.44406812794968); // 마커가 표시될 위치입니다

// 마커를 생성합니다
var marker = new kakao.maps.Marker({
    position: markerPosition, 
    image: markerImage // 마커이미지 설정 
});

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);  

const addr = document.querySelector('.addr').textContent;
const copy = document.querySelector('.copy');
copy.addEventListener('click', copyClipboard)
function copyClipboard() {
    window.navigator.clipboard.writeText(addr).then(()=>{
        alert("클립보드에 주소가 복사되었습니다.");
    })
}