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


  {{-- <div id="dropin-container"></div>
  <button id="submit-button">Request payment method</button> --}}

    <form method="post" id="payment-form" action="#">
        <section>
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
            </label>

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>

  {{-- authorization: 'sandbox_rz8r6b9s_r3wz32g49xjhgn4p' --}}


  {{-- SCRIPT PER FAR GIRARE BRAINTREE --}}
  {{-- <script>
    var orderUri = "{{ route('pagamento', $newOrder -> id)}}";
    var buttonBasic = document.querySelector('#submit-button');
    braintree.dropin.create({
      authorization: "{{ \Braintree\ClientToken::generate() }}",
      container: '#dropin-container'
      }, function (createErr, instance) {
          buttonBasic.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {

              $.ajax({
                url: "{{ route('pagamento') }}",
                success: true,
                type: "GET",
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
  </script> --}}




@endsection
