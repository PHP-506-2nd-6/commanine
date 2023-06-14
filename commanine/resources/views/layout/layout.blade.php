<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{asset('css/header.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Main</title>
</head>
<body>
    @include('layout.inc.header')

    @yield('contents')

    @include('layout.inc.footer')

{{-- <script src="{{asset('js/header.js')}}"></script> --}}
</body>
</html>
