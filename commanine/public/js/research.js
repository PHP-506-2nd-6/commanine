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
      x1 = x1.replace(rgx, '$1' + ' ' + '$2');
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
// 인원input을 눌렀을 때 
countInput.addEventListener('click',function(){
  countBox.classList.toggle('active');
})

countChkBtn.addEventListener('click',function(){
    countBox.classList.toggle('active');
    adultsHide.value = adultsVal.value;
    kidsHide.value = kidsVal.value;
    countInput.value="성인 : "+adultsVal.value+" / 어린이 : "+kidsVal.value;
})
// 성인, 어린이 선택하는 박스가 뜨고
// 확인 버튼 누르면 박스 삭제
// 값 이동
