<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}} ">
    <script src="{{ asset('js/app.js')}} " charset="utf-8"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
  </head>
  <body>

    {{-- @include('components.header') --}}
    <div class="container">

      @yield('section')

    </div>
    {{-- @include('components.footer') --}}

  </body>
</html>
