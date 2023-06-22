/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : public/js
 * 파일명     : research.js
 * 이력       : 0621 KMH new
 * *********************************** */ 


// 박스 생성해서 성인과 어린이 수를 체크한 박스의 값이 form의 hidden에 각각 value 값에 들어가야함
// 확인 누르면 박스 display:none 


// 가격 슬라이드 변수
const inputLeft = document.getElementById("input-left");
const inputRight = document.getElementById("input-right");
const thumbLeft = document.querySelector(".slider > .thumb.left");
const thumbRight = document.querySelector(".slider > .thumb.right");
const range = document.querySelector(".slider > .range");
const minVal = document.querySelector('.minVal');
const maxVal = document.querySelector('.maxVal');
// 가격 슬라이드 변수 end
// 인원 박스 
const countBox = document.querySelector('.countBox');
const countInput = document.querySelector('.countInput');
const countChkBtn = document.querySelector('.countChkBtn');
const adultsVal = document.querySelector('.adultsVal');
const kidsVal = document.querySelector('.kidsVal');
const adults = document.querySelector('#adults');
const kids = document.querySelector('#kids');

const pagination = document.querySelector(".page > nav > .d-none");
const pages = document.querySelector(".pages");
const pagesNav = document.querySelector(".pages > nav");

pagesNav.style.display= "block";
//가격 슬라이드 
const setLeftValue = () => {
  const _this = inputLeft;
  const [min, max] = [parseInt(_this.min), parseInt(_this.max)];
  // 교차되지 않게, 1을 빼준 건 완전히 겹치기보다는 어느 정도 간격을 남겨두기 위해.
  _this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);
  // input, thumb 같이 움직이도록
  const percent = ((_this.value - min) / (max - min)) * 100;
  thumbLeft.style.left = percent + "%";
  range.style.left = percent + "%";
};

const setRightValue = () => {
  const _this = inputRight;
  const [min, max] = [parseInt(_this.min), parseInt(_this.max)];
  // 교차되지 않게, 1을 더해준 건 완전히 겹치기보다는 어느 정도 간격을 남겨두기 위해.
  _this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);
  // input, thumb 같이 움직이도록
  const percent = ((_this.value - min) / (max - min)) * 100;
  thumbRight.style.right = 100 - percent + "%";
  range.style.right = 100 - percent + "%";
};

inputLeft.addEventListener("input", setLeftValue);
inputRight.addEventListener("input", setRightValue);

inputLeft.addEventListener('input',function(e) {
    minVal.innerHTML = e.target.value;
});
inputRight.addEventListener('input',function(e) {
    maxVal.innerHTML = e.target.value;
});

// 인원을 클릭했을 때 성인, 어린이를 선택할 수 있는 박스 생성
countInput.addEventListener('click',function(e){
  countBox.classList.toggle('active');
})


countChkBtn.addEventListener('click',function(e){
  countBox.classList.toggle('active');
  adults.setAttribute('value',adultsVal.value);
  kids.setAttribute('value',kidsVal.value);
  countInput.setAttribute('value', "성인 : "+adultsVal.value+" / 어린이 : "+kidsVal.value);
})

