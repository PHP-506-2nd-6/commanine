/**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : public/js
 * 파일명     : research.js
 * 이력       : 0621 KMH new
 * *********************************** */ 
//가격 range
$(function() {

  function addSeparator(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }

  function updateRangeValues() {
    var rangeGroup = $(this).attr('name'),
      minBtn = $(this).parent().children('.min'),
      maxBtn = $(this).parent().children('.max'),
      range_min = $(this).parent().children('.range_min'),
      range_max = $(this).parent().children('.range_max'),
      minVal = parseInt($(minBtn).val()),
      maxVal = parseInt($(maxBtn).val()),
      origin = $(this).context.className;

    if (origin === 'min' && minVal > maxVal - 5) {
      $(minBtn).val(maxVal - 5);
    }
    minVal = parseInt($(minBtn).val());
    $(range_min).html(addSeparator(minVal) + ' 원');

    if (origin === 'max' && maxVal - 5 < minVal) {
      $(maxBtn).val(5 + minVal);
    }
    maxVal = parseInt($(maxBtn).val());
    $(range_max).html(addSeparator(maxVal) + ' 원');
  }

  $('input[type="range"]').on('input', updateRangeValues);

  function updateRangeThumb() {
    var minRange = 0; // input range의 최소 값
    var maxRange = 1000000; // input range의 최대 값

    // 검색한 min과 max 값을 input range의 값으로 설정


    // min과 max 값에 따라 동그라미의 위치 업데이트
    var range_min = $('.range_min');
    var range_max = $('.range_max');
    var minVal = parseInt($('.min').val());
    var maxVal = parseInt($('.max').val());

    // min 동그라미의 위치 업데이트
    var minPercentage = ((minVal - minRange) / (maxRange - minRange)) * 100;
    $('.min').css('background-size', minPercentage + '% 100%');
    $(range_min).html(addSeparator(minVal) + ' 원');

    // max 동그라미의 위치 업데이트
    var maxPercentage = ((maxVal - minRange) / (maxRange - minRange)) * 100;
    $('.max').css('background-size', maxPercentage + '% 100%');
    $(range_max).html(addSeparator(maxVal) + ' 원');
  }
  updateRangeThumb();
});

//가격 range end

// 인원체크 박스
const countInput = document.querySelector('.countInput');
const countBox = document.querySelector('.countBox');
const countChkBtn = document.querySelector('.countChkBtn');
const adultsVal = document.querySelector('.adultsVal');
const kidsVal = document.querySelector('.kidsVal');
const adultsHide = document.querySelector('.adultsHide');
const kidsHide = document.querySelector('.kidsHide');
const searchBtn = document.getElementById('searchBtn');
// 인원input을 눌렀을 때 
// 성인, 어린이 선택하는 박스가 뜨고
countInput.addEventListener('click',function(){
  countBox.classList.toggle('active');
})
countInput.addEventListener('blur',function(){
  countBox.classList.remove('active');
})
// 확인 버튼 누르면 박스 삭제
countChkBtn.addEventListener('click',function(){
    countBox.classList.toggle('active');
    // 값 이동
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
  if( adultsVal.value < 99 ){
  return adultsVal.value = Number(adultsVal.value) + 1;
  }
})

plusBtn[1].addEventListener('click',function(){
  if( kidsVal.value < 99 ){
  return kidsVal.value = Number(kidsVal.value) + 1;
  }
})


