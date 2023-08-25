<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="https://erp.atsbd.net/dist/img/fevi.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/css/icons.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/css/app.min.css') }}" type="text/css">
</head>
<body>
    @yield('main-body')

    {{-- JS Files --}}
    <script src=""></script>
</body>
<script>
    Array.from(document.querySelectorAll("form .auth-pass-inputgroup")).forEach(function(e){Array.from(e.querySelectorAll(".password-addon")).forEach(function(r){r.addEventListener("click",function(r){var o=e.querySelector(".password-input");"password"===o.type?o.type="text":o.type="password"})})});
</script>
</html>