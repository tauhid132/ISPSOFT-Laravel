<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="icon" href="{{ asset('images/fevicon.png') }}" />
  
  <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('theme/css/icons.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('theme/css/app.min.css') }}" type="text/css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <link href="{{ asset('theme/libs/overlay-scrollbar/css/overlayscrollbars.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('theme/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('theme/libs/formwizard/jquery-steps.css') }}">
  
  <style>
    .select2-container .select2-search--inline .select2-search__field {
      height: 24px; !important
    }
  </style>
  @yield('custom-stylesheet')
  
</head>


<body>
  @if(Auth::guard('reseller')->check())
  @include('selfcare.includes.header-reseller')
  @elseif (Auth::guard('web')->check())
  @include('selfcare.includes.header-user')
  @endif

  @if(Auth::guard('reseller')->check())
  @include('selfcare.includes.navbar-reseller')
  @elseif (Auth::guard('web')->check())
  @include('selfcare.includes.navbar-user')
  @endif
  
  
  @yield('main-body')
  
  
</body>


<script src="{{ asset('theme/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('theme/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('theme/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('theme/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('theme/libs/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('theme/libs/formwizard/jquery-steps.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('theme/js/app.js') }}"></script>

@yield('page-script')

<script>
  $('.select-search').select2();
  $(".js-example-basic-multiple").select2();
  
</script>
</html>