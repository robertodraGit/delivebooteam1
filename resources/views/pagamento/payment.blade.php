<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <script src="{{asset('/js/app.js')}}" ></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

      <div class="pay-wallpaper">

        @if (session('success_message'))
          <div class="alert alert-success">
            {{ session('success_message')}}
          </div>

        @endif

        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors ->all() as $errors)
                <li>{{ $errors }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


        <div class="col-md-6 p-3">
            <div class="basic_spnsr">
              <div class="row justify-content-center">
                <h1>Seleziona un metodo di Pagamento</h1>
              </div>
              <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                  <div>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-md-10 d-flex flex-column justify-content-center">

                      {{-- inizia contenuto braintree (script all'interno del content --}}
                      <div class="content">

                        <form method="post" id="payment-form" action="{{ url('/checkout') }}">
                          @csrf
                          @method('post')

                            {{-- ricordare che ci sono input nascosti che utente non dovrà modificare --}}

                            <section>
                              {{-- <label for="email">email utente: </label> --}}
                              <input type="text" name="email" value="{{ $email }}">
                              <label id="input-amount" for="amount">
                                  <h2 class="input-label">
                                    totale da pagare: {importo che arriva dal carrello.}
                                  </h2>

                                  <div class="input-wrapper amount-wrapper">
                                      {{-- questo input sarà hidden perché il prezzo da pagare arriverà dal carrello --}}
                                      <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10" >
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
                            var email = "{{ $email }}";
                            var client_token = "{{ $token }}";


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

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </div>





    </body>
</html>
