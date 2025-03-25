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
    .select2-container .select2-selection--single {
    border: 1px solid var(--vz-input-border);
    height: calc(1.5em + 1rem + 2px);
    line-height:36px;
    background-color: var(--vz-input-bg);
    outline: 0;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 36px;
}
    /* .select2-container .select2-search--inline .select2-search__field {
      height: 40px; !important
    } */
    /* .select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
    padding-left: 12px;
    color: var(--vz-body-color);
    } */
  </style>
  @yield('custom-stylesheet')
  
</head>


<body>
  @if(Auth::guard('admin')->check())
  @if (Auth::guard('admin')->user()->role == 'Admin')
  @include('admin.includes.navbar-admin')
  @elseif (Auth::guard('admin')->user()->role == 'Accountant')
  @include('admin.includes.navbar-accountant')
  @elseif (Auth::guard('admin')->user()->role == 'Support')
  @include('admin.includes.navbar-support')
  @elseif (Auth::guard('admin')->user()->role == 'Sales-Marketing')
  @include('admin.includes.navbar-sales-marketing')
  @endif
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
  // $('.select-search').select2();
  // $(".js-example-basic-multiple").select2();
  function formatState(e){return e.id?$('<span><img src="assets/images/flags/select2/'+e.element.value.toLowerCase()+'.png" class="img-flag rounded" height="18" /> '+e.text+"</span>"):e.text}function formatState(e){var t;return e.id?((t=$('<span><img class="img-flag rounded" height="18" /> <span></span></span>')).find("span").text(e.text),t.find("img").attr("src","assets/images/flags/select2/"+e.element.value.toLowerCase()+".png"),t):e.text}$(document).ready(function(){$(".js-example-basic-single").select2(),$(".js-example-basic-multiple").select2();$(".js-example-data-array").select2({data:[{id:0,text:"enhancement"},{id:1,text:"bug"},{id:2,text:"duplicate"},{id:3,text:"invalid"},{id:4,text:"wontfix"}]})}),$(".js-example-templating").select2({templateResult:formatState}),$(".select-flag-templating").select2({templateSelection:formatState}),$(".js-example-disabled").select2(),$(".js-example-disabled-multi").select2(),$(".js-programmatic-enable").on("click",function(){$(".js-example-disabled").prop("disabled",!1),$(".js-example-disabled-multi").prop("disabled",!1)}),$(".js-programmatic-disable").on("click",function(){$(".js-example-disabled").prop("disabled",!0),$(".js-example-disabled-multi").prop("disabled",!0)});
</script>
</html>