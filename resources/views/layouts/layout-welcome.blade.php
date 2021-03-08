<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- style --}}
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">

    {{-- js --}}
    <script src="{{asset('/js/app.js')}}"></script>
</head>
<body>

    <div id="app" class="container-welcome">
        @include('components.header')
        @yield('content')
    </div>


</body>
</html> 