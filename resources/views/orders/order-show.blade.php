@extends('layouts.main-layout')

@section('content')

  <br>
  <h1>
    Riepilogo ordine:
  </h1>

  <h1>ID: {{$newOrder -> id}}</h1>
  <h2>Nome: {{$newOrder -> first_name}}</h2>
  <h2>cognome: {{$newOrder -> last_name}}</h2>
  <h2>email: {{$newOrder -> email}} </h2>
  <h2>phone: {{$newOrder -> phone}}</h2>
  <h2>
    total price: {{$newOrder -> total_price/100}} €
  </h2>
  {{-- <h1><a href="{{ route('orders-index')}}">Indietro alla index-new</a></h1> --}}



  <br>
  <br>
  <br>

  {{-- PAGAMENTO --}}
  <h1>parte che vedrà cliente non registrato:</h1>
  <h1>
    Somma da pagare:
    {{$newOrder -> total_price/100}} €
  </h1>
  <h1>
    ristorante a cui pagare:
    {{$restoraunt -> name}}
    {{$restoraunt -> email}}
    {{$restoraunt -> phone}}
  </h1>

  {{-- <h1>
    <a href="{{ route('pay')}}">ROTTA PER IL PAGAMENTO</a>
  </h1> --}}
  <h1>Seleziona un metodo di Pagamento</h1>

  {{-- inizia contenuto braintree (script all'interno del content --}}
  <div class="content">

    <form method="post" id="payment-form" action="{{ route('checkout') }}">
      @csrf
      @method('post')

        {{-- ricordare che ci sono input nascosti che utente non dovrà modificare --}}

        <section>
          <label for="restaurant-email">ristorante a cui ordino:</label>
          <input type="text" name="restourant-email" value="{{ $restoraunt -> email }}">
          <label for="restaurant-name">nome ristorante:</label>
          <input type="text" name="restourant-name" value="{{ $restoraunt -> name }}">
          <br>
          <label for="email">email utente: </label>
          <input type="text" name="email" value="{{$newOrder -> email}}">
          <br>
          <label for="name">name utente: </label>
          <input type="text" name="name" value="{{$newOrder -> first_name}}">
          <br>
          <label for="last_name">lastname utente: </label>
          <input type="text" name="last_name" value="{{$newOrder -> last_name}}">
          <label id="input-amount" for="amount">
              <h2 class="input-label">
                totale da pagare:
              </h2>

              <div class="input-wrapper amount-wrapper">
                  {{-- questo input sarà hidden perché il prezzo da pagare arriverà dal carrello --}}
                  <input id="amount" name="amount" type="tel" min="1" placeholder="Amount"
                  value=" {{$newOrder -> total_price/100}} " >
              </div>
          </label>

          <div class="bt-drop-in-wrapper">
              <div id="bt-dropin"></div>
          </div>
        </section>



        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button id="pay-button" class="button" type="submit"><span>Effettua il pagamento</span></button>
    </form>


    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.73.1/js/hosted-fields.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        // esempio email utente che ha pagato
        var email = "{{$newOrder -> email}}";
        var custName = "{{$newOrder -> first_name}}"
        var custLastName = "{{$newOrder -> last_name}}"
        var client_token = "{{ $token }}";
        var restEmail = "{{ $restoraunt -> email}}";
        var restName = "{{ $restoraunt -> name}}";


        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {

              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>

  </div>




@endsection
