@extends('layout.layout')
    {{-- 체크인 체크아웃 계산 --}}
<?php
    $from = new Datetime($data->chk_in);
    $to = new Datetime($data->chk_out);
    $gap = date_diff( $from, $to )->days;
?>
<head>
    <link rel="stylesheet" href="{{asset('css/payment.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"/>
</head>
@section('contents')
<div class="payCon">
    <div class="paymentInfo">
        <div class="roomName">
            <p class="hanokName">{{$data->hanok_name}}</p>
            <p>{{$data->room_name}}</p>
        </div>
        <form action="{{route('users.payment.comp')}}" method="post">
        @csrf
        <div class="payContainer">
            <div class="items">
                <div class="font_size">체크인</div>
                <input type="hidden" name="chk_in_date" id="chk_in_date" value="{{$data->chk_in}}">
                <div>{{$data->chk_in}}</div>
            </div>
            <div class="items">
                <div class="font_size">체크아웃</div>
                <input type="hidden" name="chk_out_date" id="chk_out_date" value="{{$data->chk_out}}">
                <div>{{$data->chk_out}}</div>
            </div>
        </div>
    </div>

    <div class="reserveInfo">
        <div class="reservetitle">
            <p class="border_line">예약자 정보</p>
            <input type="hidden" name="room_id" id="room_id" value="{{$data->room_id}}">
            <input type="hidden" name="reserve_adult" id="reserve_adult" value="{{$data->reserve_adult}}">
            <input type="hidden" name="reserve_child" id="reserve_child" value="{{$data->reserve_child}}">
            {{-- 0629 ysh 시간되면 css 바꾸기 --}}
            <input type="hidden" name="reserve_price" value="{{$gap * (int)$data->room_price}}">
            @include('layout.errors_validate')
            <label for="reserve_name">예약자 이름</label>
            <br>
            <input type="text" name="reserve_name" id="reserve_name" placeholder="한글로 성명을 입력해주세요" autocomplete="off"'>
            <div id="reserve_name_inner"></div>
            <br>
            <label for="reserve_num">예약자 전화 번호</label>
            <br>
            <input type="text" name="reserve_num" id="reserve_num" placeholder="'-' 없이 숫자로 전화번호를 입력해주세요" autocomplete="off">
            <div id="reserve_num_inner"></div>
        </div>
        <div class="reservetitle pay_padding">
            <p>결제 금액</p>
            <div class="pay_sum">
                <div class="product_sum_flex1">
                    <span class="span_r">상품 금액 :</span>
                    <span class="span_padding_1">{{number_format($gap * (int)$data->room_price)}}</span>
                </div>
                <br>
                <div class="product_sum_flex2">
                    <span class="span_r">총 결제 금액 :</span>
                    <span class="span_padding_2">{{number_format($gap * (int)$data->room_price)}}</span>
                </div>
                {{-- 0629 ysh 시간되면 span 대신 input 넣어서 교체 --}}
                {{-- <input type="text" name="reserve_price" value="{{number_format($gap * (int)$data->room_price)}}"> --}}
            </div>
        </div>
        <div class="reservetitle pay_padding">
            <span class="span_r">결제 수단</span>
            <span class="pay_padding_select">
                <select name="pay_type" class="pay_type">
                    <option value="신용카드">신용카드</option>
                </select>
            </span>
        </div>
        <div class="pay_padding">
            <input type='checkbox' name='selectall' value='selectall' onclick='selectAll(this)' required />
            <span class="font_size">필수 약관 전체 동의</span>
            <br>
            <input type='checkbox' name='animal' value='dog' onclick='checkSelectAll()' required />
            만 14세 이상 이용 동의
            <br>
            <div class="agree" style="height: 100px; overflow: auto"> 
                <div style="height: 80px;"> 만 14세 이상 이용 동의
                    약관 동의 안내: [회사명]에서 제공하는 [서비스 또는 앱명]의 이용에 앞서, 만 14세 이상의 사용자만 해당 서비스를 이용할 수 있습니다. 만 14세 이상인 경우에만 앱을 설치하거나 서비스를 이용해 주시기 바랍니다.

                    서비스 이용 조건:

                    1. 만 14세 미만의 사용자는 본 서비스의 이용이 불가능합니다.
                    2. 만 14세 이상인 사용자는 개인 정보를 올바르게 제공해야 합니다.
                    3. 만 14세 이상인 사용자는 본 약관에 동의함으로써, [회사명]의 개인정보 처리 방침에 동의하는 것으로 간주됩니다.
                    4. 사용자는 서비스를 사용함으로써 발생하는 모든 활동과 책임에 대해 전적으로 책임져야 합니다.
                    5. 사용자는 앱 또는 서비스를 무단으로 수정, 복제, 배포하는 행위를 금지합니다.
                    동의 여부: 본 약관에 따라, 만 14세 이상이며 [회사명]의 이용 조건을 읽고 이해하였으며, 이에 동의합니다.</div>
            </div>
            <br>
            <input type='checkbox' name='animal' value='cat' onclick='checkSelectAll()' required />
            개인 정보 수집 동의
            <br>
            <div class="agree" style="height: 100px; overflow: auto"> 
                <div style="height: 80px;"> 개인 정보 수집 동의

                약관 동의 안내: [회사명]은 [서비스 또는 앱명]의 이용자들에게 최적화된 서비스를 제공하기 위해 일부 개인 정보를 수집 및 이용합니다. 이에 대해 아래와 같이 동의 여부를 확인해 주시기 바랍니다.

                1. 수집하는 개인 정보 항목:

                [서비스 또는 앱명]은 다음과 같은 개인 정보를 수집합니다:
                이름, 이메일 주소, 전화번호 등 연락처 정보
                주소, 우편번호 등의 배송지 정보
                로그인 정보 (아이디, 비밀번호)
                서비스 이용 기록, 접속 로그 등

                2. 개인 정보 수집 및 이용 목적:

                [서비스 또는 앱명]은 다음과 같은 목적으로 개인 정보를 수집 및 이용합니다:
                회원 가입 및 인증
                서비스 제공 및 운영
                상품 배송 및 결제 처리
                서비스 이용 통계 및 분석
                서비스 개선 및 개발

                3. 개인 정보 제공 및 제3자 제공:

                [서비스 또는 앱명]은 원칙적으로 사용자의 개인 정보를 제3자에게 제공하지 않습니다. 단, 아래의 경우에는 개인 정보를 제공할 수 있습니다:
                사용자의 동의가 있는 경우
                법령에 따라 요구되는 경우
                개인 정보 보유 기간:

                사용자의 개인 정보는 서비스 이용 목적이 달성된 후에는 지체 없이 파기될 수 있도록 처리됩니다.
                동의 여부: [서비스 또는 앱명]의 개인 정보 수집 및 이용에 동의하며, 서비스 제공을 위해 필요한 개인 정보의 수집 및 이용에 동의합니다.
                </div>
            </div>
            <br>
            <input type='checkbox' name='animal' value='rabbit' onclick='checkSelectAll()' required />
            개인 정보 제 3자 제공 동의
            <br>
            <div class="agree"  style="height: 100px; overflow: auto"> 
                <div style="height: 80px;"> 개인 정보 수집 동의

                약관 동의 안내: [회사명]은 [서비스 또는 앱명]의 이용자들에게 최적화된 서비스를 제공하기 위해 일부 개인 정보를 수집 및 이용합니다. 이에 대해 아래와 같이 동의 여부를 확인해 주시기 바랍니다.

                1. 수집하는 개인 정보 항목:

                [서비스 또는 앱명]은 다음과 같은 개인 정보를 수집합니다:
                이름, 이메일 주소, 전화번호 등 연락처 정보
                주소, 우편번호 등의 배송지 정보
                로그인 정보 (아이디, 비밀번호)
                서비스 이용 기록, 접속 로그 등

                2. 개인 정보 수집 및 이용 목적:

                [서비스 또는 앱명]은 다음과 같은 목적으로 개인 정보를 수집 및 이용합니다:
                회원 가입 및 인증
                서비스 제공 및 운영
                상품 배송 및 결제 처리
                서비스 이용 통계 및 분석
                서비스 개선 및 개발

                3. 개인 정보 제공 및 제3자 제공:

                [서비스 또는 앱명]은 원칙적으로 사용자의 개인 정보를 제3자에게 제공하지 않습니다. 단, 아래의 경우에는 개인 정보를 제공할 수 있습니다:
                사용자의 동의가 있는 경우
                법령에 따라 요구되는 경우
                개인 정보 보유 기간:

                사용자의 개인 정보는 서비스 이용 목적이 달성된 후에는 지체 없이 파기될 수 있도록 처리됩니다.
                동의 여부: [서비스 또는 앱명]의 개인 정보 수집 및 이용에 동의하며, 서비스 제공을 위해 필요한 개인 정보의 수집 및 이용에 동의합니다.
                </div>
            </div>
        </div>
        <br>
        <br>
        
        <div class="btn_group">
        <button type="submit" class="btn1">예약하기</button>
        <button type="button" class="btn2" onclick="location.href='{{route('hanoks.detail', ['id' => $data->hanok_id])}}'">취소</button>
        </div>
        </form>
    </div>
</div>

<script src="{{asset('js/payment.js')}}"></script>
@endsection
@if(session()->has('value'))
    
<script>
    alert('이미 예약된 방입니다.')

function toggleFormSection() {
            const formSection = document.getElementById('formSection');
            const showFormButton = document.getElementById('showFormButton');

            if (formSection.style.height === '0px') {
                // 입력 폼이 숨겨진 경우 보이도록 설정
                formSection.style.height = '500px';
                showFormButton.textContent = '입력 폼 숨기기';

                // 입력 폼이 위치한 곳으로 스크롤
                formSection.scrollIntoView({ behavior: 'smooth' });
            } else {
                // 입력 폼이 보이는 경우 숨기도록 설정
                formSection.style.height = '0px';
                showFormButton.textContent = '입력 폼 보기';
            }
        }
        function toggleFormSection2() {
            const formSection = document.getElementById('formSection2');
            const showFormButton = document.getElementById('showFormButton2');

            if (formSection.style.height === '0px') {
                // 입력 폼이 숨겨진 경우 보이도록 설정
                formSection.style.height = '500px';
                showFormButton.textContent = '입력 폼 숨기기';

                // 입력 폼이 위치한 곳으로 스크롤
                formSection.scrollIntoView({ behavior: 'smooth' });
            } else {
                // 입력 폼이 보이는 경우 숨기도록 설정
                formSection.style.height = '0px';
                showFormButton.textContent = '입력 폼 보기';
            }
        }


</script>
@endif