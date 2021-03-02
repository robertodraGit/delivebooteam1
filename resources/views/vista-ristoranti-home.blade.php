<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <script src="{{asset('/js/app.js')}}" ></script>
  </head>
  <body>
    <h3>Vista dei ristoranti:</h3>
    <div id="app">

        {{-- Tutti i ristoranti --}}
        {{-- <restaurant
          v-for="restaurant in restaurants"
          :key="restaurant.id"
          :restaurant_data="restaurant"
        ></restaurant> --}}

        <div v-for="restaurant in restaurants" :key="restaurant.id">
            <restaurant
              :restaurant_data="restaurant"
            ></restaurant>
        </div>

    </div>
  </body>
</html>
