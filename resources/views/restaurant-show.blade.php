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

            @@carrello='pushInCart($event)'

          ></plate>
        @endif
      @endforeach

      <div class="cart-fixed" v-if='cart.length > 0'>
        Carrello: <br>

        <p>@{{cart_new}}</p>

        <div class='sub-cart-elements' v-for='plate in cart'>
          {{-- <div>  
                @{{plate.plate_name}} / 
                @{{plate.plate_price}} € 
        </div> --}}
        </div>
        <div>
          Totale: @{{total}}
          <button @click='get_cart()'>
            Carrello
          </button>
          <br>
          <button @click='reset_cart()'>
            Svuota carrello
          </button>
        </div>
      </div>
    

    </div>
  </body>
</html>
