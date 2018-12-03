<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Pemuda Ingin Surga')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('backend/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('backend/favicon-16x16.png') }}" sizes="16x16">
    <link rel="manifest" href="{{ asset('backend/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('backend/safari-pinned-tab.svg') }}" color="#2c3e50">
    <meta name="theme-color" content="#ffffff">

    @include('backend.template.head')
  </head>
  <body class="layout layout-header-fixed">
    @include('backend.template.header')
    <div class="layout-main">
      @include('backend.template.sidebar')
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <div class="title-bar-actions">
              @yield('title-bar-actions')
            </div>
            <h1 class="title-bar-title">
              <span class="d-ib">@yield('title-bar-title', 'PIS')</span>
            </h1>
            <p class="title-bar-description">
              <small>@yield('title-bar-description', 'Pemuda Ingin Surga')</small>
            </p>
          </div>
          @yield('content')
        </div>
      </div>
      @include('backend.template.footer')
    </div>

    @include('backend.template.script')
  </body>
</html>
