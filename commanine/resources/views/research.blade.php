{{--
 /**************************************
 * 프로젝트명 : commanine
 * 디렉토리   : resources/views
 * 파일명     : research.blade.php
 * 이력       : 0616 KMH new
 * *********************************** */ 
 --}}
@extends('layout.layout')
{{-- <head>
    <link rel="stylesheet" href="{{asset('css/reseach.css')}}">
</head> --}}
@section('contents')
    @foreach($searches  as $search)
        <tr>
            <th scope="row">{{$search->id}}</th>
            <td>{{$search->hanok_name}}</td>
            <td>{{$search->hanok_img1}}</td>
        </tr>
    @endforeach
@endsection