<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DelivebooHome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}} ">

    {{-- cdn fontawesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <script src="{{ asset('js/app.js')}} " charset="utf-8"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
  </head>
  <body>

    @include('components.header')

    @yield('content')

    {{-- @include('components.footer') --}}

  </body>
</html>
