<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <script src="{{asset('/js/app.js')}}" ></script>

    @php
      // Fa ritornare il voto medio
      $average_vote;
      $vote_number;
      $vote_int;
      $vote_decimal;

      $votes = [];
      foreach ($restaurant -> feedback as $feedback) {
        $votes[] = $feedback-> rate;
      };

      if ($votes) {
        $average_vote = array_sum($votes)/count($votes);
        $average_vote = round ($average_vote , 1);
        $vote_number = count($votes);
        $vote_int = intval($average_vote);
        $vote_decimal = ($average_vote - $vote_int) * 10;
        $vote_decimal = number_format($vote_decimal);
      } else {
        $average_vote = 0;
        $vote_number = 0;
        $vote_int = 0;
        $vote_decimal = 0;
      }
      // dd($average_vote, $vote_int, $vote_decimal * 10);
    @endphp

  </head>
  <body>
    <div id="app">

      <header>
        <div class="container">
          <a href="{{route('index')}}" class="logo">
              <img src="{{asset('storage/img/deliveroo-logo.svg')}}" alt="">
          </a>
          <div class="cart_header">

            <div class="box">

              <svg height="24" width="24" viewBox="0 0 24 24">
                  <path d="M14 15V13H10V15H14ZM15 15H19.1872L19.7172 13H15V15ZM14 12V10H15V12H19.9822L20.5122 10H3.48783L4.01783 12H9V10H10V12H14ZM14 18V16H10V18H14ZM15 18H18.3922L18.9222 16H15V18ZM9 15V13H4.28283L4.81283 15H9ZM9 18V16H5.07783L5.60783 18H9ZM7 8V3H17V8H23L20 20H4L1 8H7ZM9 8H15V5H9V8Z"></path>
              </svg>

              <p class="header_price">@{{total}}€</p>

            </div>

          </div>
        </div>
      </header>


      <div class="rest_info_show">
        <section class="rest_info_left">

          <h2 class="rest_name">{{$restaurant -> name}}</h2>
          <div class="rate-box">
              {{-- stelline piene --}}
              @if ($vote_int > 0)
                @for ($i=0; $i < $vote_int; $i++)
                  <i class="fas fa-star"></i>
                @endfor
              @endif
              {{-- stellina parziale --}}
              @if ($vote_decimal >= 0 && $vote_decimal < 3)
                <i class="far fa-star"></i>
              @endif
              @if ($vote_decimal >= 4 && $vote_decimal < 7 )
                <i class="fas fa-star-half-alt"></i>
              @endif
              @if ($vote_decimal >= 8)
                <i class="fas fa-star"></i>
              @endif
              {{-- stelline rimanenti --}}
              @if (5 - $vote_int > 0)
                @for ($i=0; $i < (5 - $vote_int - 1); $i++)
                  <i class="far fa-star"></i>
                @endfor
              @endif

              <span class="rate">{{$average_vote}}</span>
              <span class="feed_number">({{$vote_number}} valutazioni)</span>
          </div>
          <div class="typology-box">
            @foreach ($restaurant -> typologies as $typ)
              <span>{{$typ -> typology}}</span>
            @endforeach
          </div>
          <div class="more_info">
            <h4 class="more-info-title">Descrizione:</h4>
            <p class="rest_desc">{{$restaurant -> description}}</p>
            <p class="rest_phone">Contattaci allo: {{$restaurant -> phone}}</p>
          </div>

        </section>

        <section class="rest_info_right">
          <div class="rest_photo">
            @if ($restaurant -> photo != null)
              <div class="photo" style="background-image: url(/storage/restaurant_icon/{{$restaurant -> photo}})"></div>
            @else
              <div class="photo" style="background-image: url(/storage/placeholder.svg)"></div>
            @endif
          </div>
          <div class="delivery-box">
            <i class="fas fa-bicycle"></i>
            <div class="">
              <p class="rest_address">Indirizzo: {{$restaurant -> address}}</p>
              <p class="rest_delivery_cost">Prezzo di consegna: {{($restaurant -> delivery_cost / 100)}}€</p>
            </div>
          </div>
        </section>
      </div>

      <main id="rest_show_main">

        <section class="rest_show_left">

          @foreach ($restaurant -> plates as $plate)
            @if ($plate -> visible)
              <plate
                :plate_data='{{$plate}}'

                @@carrello='pushInCart($event)'

              ></plate>
            @endif
          @endforeach

        </section>

        <section class="rest_show_right">
          <div class="cart-fixed" v-if='cart.length > 0'>
            Carrello: <br>

            <div v-for='item in cart_new'>
              @{{item.plate_name}} / x @{{item.quantity}} = @{{item.plate_price}} €
            </div>

            <br>

            <div>
              sub total: @{{total}} € <br>
              {{$restaurant -> delivery_cost / 100}} € -> consegna
              <br>

              <button @click='get_cart()'>
                Carrello
              </button>

              <br>

              <button @click='reset_cart()'>
                Svuota carrello
              </button>

            </div>
          </div>

        </section>


      </main>


    </div>
  </body>
</html>
