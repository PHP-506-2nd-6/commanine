{{-- /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : errors_validate.blade.php
 * 이력       : 0614 KMH new
 * *********************************** */ --}}
@if( count($errors) > 0 )
    {{-- erros->all() $errors객체에서 필요한 것만 가져와줌 --}}
    @foreach($errors->all() as  $error)
        <div>{{$error}}</div>
    @endforeach
@endif
@if(session()->has('error'))
    <div>{!!session('error')!!}</div>
@endif