/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : public/js
 * 파일명     : detail.js
 * 이력       : 0615 KMJ new
 *              0619 KMJ add
 *              0625 KMJ add
 * *********************************** */ 
const tabs = document.querySelectorAll('.tabBtn');
const contents = document.querySelectorAll('.content');
const longitude = document.querySelector('#longitude').value;
const latitude = document.querySelector('#latitude').value;

const searchBtn = document.querySelector('.searchBtn');
const reserveBtn = document.querySelectorAll('.reserveBtn');
const room_id = document.querySelector('.room_id');

const frm = document.querySelector('#frm');
const likeBtn = document.querySelector(".like");

const hanokId = window.location.pathname.substring(15);

// 검색했을 때 hanok_id sumbit 안 되도록 막는 기능
searchBtn.addEventListener('click', () => {
    room_id.disabled = true;
    frm.action="";
})

// 0625 KMJ add
// 예약하기 누르면 hanok_id 전달되도록 하는 기능
reserveBtn.forEach((btn, index)=> {
    btn.addEventListener('click', () => {
        // 폼 action 결제 페이지로 바꾸기
        frm.action="http://192.168.0.40/users/payment";
        // room_id활성화 시키고 버튼 value에 있는 객실 번호 전달
        room_id.disabled = false;
        room_id.value = reserveBtn[index].value;
        frm.submit();
    })
})

// 인원체크 박스
const countInput = document.querySelector('.countInput');
const countBox = document.querySelector('.countBox');
const countChkBtn = document.querySelector('.countChkBtn');
const adultsVal = document.querySelector('.adultsVal');
const kidsVal = document.querySelector('.kidsVal');
const adultsHide = document.querySelector('.adultsHide');
const kidsHide = document.querySelector('.kidsHide');

// 인원input을 눌렀을 때 
// 성인, 어린이 선택하는 박스가 뜨고
countInput.addEventListener('click',function(){
    countBox.classList.toggle('active');
})
countInput.addEventListener('change',function(){
    countBox.classList.remove('active');
})
// 확인 버튼 누르면 박스 삭제
countChkBtn.addEventListener('click',function(){
    // 값 이동
    countBox.classList.toggle('active');
    adultsHide.value = adultsVal.value;
    kidsHide.value = kidsVal.value;
    countInput.value="성인 : "+adultsVal.value+" / 어린이 : "+kidsVal.value;
})
// min 버튼 누르면 input number 숫자 감소,
// plus 버튼 누르면 input number 숫자 증가,
const minBtn = document.querySelectorAll('.minBtn');
const plusBtn = document.querySelectorAll('.plusBtn');


minBtn[0].addEventListener('click',function(){
    if( adultsVal.value > 0 ){
    return adultsVal.value = Number(adultsVal.value) - 1;
    }
})

minBtn[1].addEventListener('click',function(){
    if( kidsVal.value > 0 ){
    return kidsVal.value = Number(kidsVal.value) - 1;
    }
})

plusBtn[0].addEventListener('click',function(){
    if( adultsVal.value < 16 ){
    return adultsVal.value = Number(adultsVal.value) + 1;
    }
})

plusBtn[1].addEventListener('click',function(){
    if( kidsVal.value < 16 ){
    return kidsVal.value = Number(kidsVal.value) + 1;
    }
})


const queryStr = document.location.search;
const param = new URL(location).searchParams;
const page = param.get("page");
const roomBtn = document.querySelector(".roomBtn");
const revBtn = document.querySelector(".revBtn");
const roomCon = document.querySelector(".roomCon");
const revCon = document.querySelector(".revCon");
// const line = document.querySelector('.line');

// line.style.width = roomBtn.offsetWidth + "px";
// line.style.left = roomBtn.offsetLeft + "px";

// 후기페이지 눌렀을 때 페이지 넘어가면 탭 유지
if (page !== null) {
    roomBtn.classList.remove('active');
    revBtn.classList.add('active');
    roomCon.classList.remove('active');
    revCon.classList.add('active');
    // line.style.width = revBtn.offsetWidth + "px";
    // line.style.left = revBtn.offsetLeft + "px";
} else {
    roomBtn.classList.add('active');
    roomCon.classList.add('active');
}

// 탭 메뉴
tabs.forEach((tab, index)=>{
    tab.addEventListener('click', (e)=> {
        tabs.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');
        // 탭 메뉴 밑줄
        // line.style.width = e.target.offsetWidth + "px";
        // line.style.left = e.target.offsetLeft + "px";
        // 탭 누르면 해당 콘텐츠 보이기
        contents.forEach(content=>{content.classList.remove('active')});
        contents[index].classList.add('active');
        map.relayout();
        map.setCenter(new kakao.maps.LatLng(latitude, longitude));
    })
})

// 카카오맵
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(latitude, longitude), // 지도의 중심좌표
        level: 2 // 지도의 확대 레벨(30m)
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

var imageSrc = "http://192.168.0.40/img/map_pin.png", // 마커이미지의 주소입니다    
    imageSize = new kakao.maps.Size(36, 36), // 마커이미지의 크기입니다
    imageOption = {offset: new kakao.maps.Point(18, 36)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
    markerPosition = new kakao.maps.LatLng(latitude, longitude); // 마커가 표시될 위치입니다

// 마커를 생성합니다
var marker = new kakao.maps.Marker({
    position: markerPosition, 
    image: markerImage // 마커이미지 설정 
});

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);  

// 클립보드에 숙소 주소 복사
// 시연위해서 execCommand로 구현  0703 KMJ add
const addr = document.querySelector('.addr').textContent;
const copy = document.querySelector('.copy');
copy.addEventListener('click', copyClipboard)
function copyClipboard() {
    const copyTA = document.createElement('textarea');
    copyTA.style.position = "fixed";
    copyTA.style.opacity = "0";
    copyTA.textContent = addr;
    
    document.body.appendChild(copyTA);
    copyTA.select();
    document.execCommand("copy");
    document.body.removeChild(copyTA);
    alert("클립보드에 주소가 복사되었습니다.");
}

// const addr = document.querySelector('.addr').textContent;
// const copy = document.querySelector('.copy');
// copy.addEventListener('click', copyClipboard)
// function copyClipboard() {
//     window.navigator.clipboard.writeText(addr).then(()=>{
//         alert("클립보드에 주소가 복사되었습니다.");
//     })
// } // https 접속에서만 사용 가능하기 때문에 삭제 0703 KMJ del

// 평균 별점마다 코멘트
const rateComment = document.querySelector('.rateComment');
const rate = parseFloat(document.querySelector('.rate').innerText);
if (rate > 4.8) {
    rateComment.textContent = "최고에요";
} else if (rate > 4.5) {
    rateComment.textContent = "추천해요";
} else if(rate > 4.0) {
    rateComment.textContent = "만족해요";
} else if (rate > 3.5) {
    rateComment.textContent = "좋아요";
} else {
    rateComment.textContent = "";
}

// 리뷰 탭 평균 별점 그래프
const rating = document.querySelector('.rate').innerText;
const starTotal = 5;
const starPercentage = ((rating/starTotal)*100)

var tr=document.getElementById("stars-inner").style.width = `${starPercentage - 2.8}%`;