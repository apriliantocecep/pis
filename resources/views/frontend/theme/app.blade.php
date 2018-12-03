<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  @include('frontend.theme.head')

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  @include('frontend.theme.header')

  {{-- intro --}}

  {{-- content --}}
  @yield('content')

  @include('frontend.theme.footer')

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  @include('frontend.theme.script')
</body>

</html>
