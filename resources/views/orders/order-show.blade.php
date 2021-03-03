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


  <div id="dropin-container"></div>
  <button id="submit-button">Request payment method</button>


  {{-- authorization: 'sandbox_rz8r6b9s_r3wz32g49xjhgn4p' --}}


  {{-- SCRIPT PER FAR GIRARE BRAINTREE --}}
  <script>
    // var braintree = require('braintree');
    var buttonBasic = document.querySelector('#submit-button');
    braintree.dropin.create({
      authorization: "{{ \Braintree\ClientToken::generate() }}",
      container: '#dropin-container'
      }, function (createErr, instance) {
          buttonBasic.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
              $.ajax({
                url: "{{ route('payment-process') }}",
                method: "GET",
                data: {
                    id: {{$newOrder -> id}},
                    payload: payload
                },
                success: function (result) {
                  console.log(result);
                  alert('script eseguito');
                },
                error: function(error, status){
                  console.log('errore:' + error);
                  }
                });
              });
            });
          });
  </script>


@endsection
