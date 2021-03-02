@extends('layouts.main-layout')

@section('section')

  <br>

  <h1>
    Hai selezionato questo order:
  </h1>

  <h1>ID: {{$order -> id}}</h1>
  <h2>Nome: {{$order -> first_name}}</h2>
  <h2>cognome: {{$order -> last_name}}</h2>
  <h2>email: {{$order -> email}} </h2>
  <h2>phone: {{$order -> phone}}</h2>
  <h2>
    total price: {{$order -> total_price}} €
  </h2>
  <h1><a href="{{ route('orders-index')}}">Indietro alla index-order</a></h1>



  <br>
  <br>
  <br>

  {{-- PAGAMENTO --}}
  <h1>parte che vedrà cliente non registrato:</h1>
  <h1>
    Somma da pagare:
    {{$order -> total_price}} €
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
                url: "{{ route('payment_process') }}",
                method: "GET",
                data: {
                    id: {{$order -> id}},
                    payload: payload
                    // price: {{$order -> total_price}}
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
