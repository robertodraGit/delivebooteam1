@extends('layouts.main-layout')

@section('section')

  <br>

  <h1>
    Hai selezionato questo order non sapendo cosa sia:
    (bravo mona!!)
  </h1>

  <h1>ID: {{$order -> id}}</h1>
  <h2>Nome: {{$order -> first_name}}</h2>
  <h2>cognome: {{$order -> last_name}}</h2>
  <h2>email: {{$order -> email}} </h2>
  <h2>phone: {{$order -> phone}}</h2>
  <h2>
    total price: {{$order -> total_price}} €
  </h2>
  <h1><a href="{{ route('orders-index')}}">Indietro</a></h1>



  <br>
  <br>
  <br>

  {{-- PAGAMENTO --}}
  <h1>PAGA STRUNZ!</h1>
  <h1>
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
                    if (result.success) {
                      window.location.href = "{{ route('orders-index') }}"
                    } else {
                      alert('Transazione fallita');
                      }
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
