<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <script src="{{asset('/js/app.js')}}" ></script>
  </head>
  <body>
    <h1>ciaone da {{$restaurant -> name}}</h1>

    <div id="app">
      @foreach ($restaurant -> plates as $plate)
        @if ($plate -> visible)
          <plate
            :plate_data='{{$plate}}'
          ></plate>
        @endif
      @endforeach
    </div>
  </body>
</html>
