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
            @@prezzi='pushPricesInCart($event)'

          ></plate>
        @endif
      @endforeach

      
    <form method="POST" action="{{route('order-create')}}" enctype="multipart/form-data">

      @csrf
      @method('POST')

      <div class="cart-fixed" v-if='cartArray.length > 0'>
        Carrello: <br>

        <div v-for='item in cartArray'>
          @foreach ($restaurant -> plates as $plate)
              <div class="sub-cart-elements"
                    v-if='item == @php
                                    echo $plate -> id;
                                  @endphp'
              >
                  <div>
                    1x {{ $plate -> plate_name }}
                  </div> 
                  <div>
                    {{ number_format((($plate -> price - ($plate -> discount * $plate -> price / 100)) / 100), 2, ',', '') }} €
                  </div>
              </div>
          @endforeach
        </div><br>

        <div>
          
          <button @click='cartSend()' class="button is-primary">
            vai al carrello
          </button>
      
        </div>
      </div>
    </form>

    </div>
  </body>
</html>
