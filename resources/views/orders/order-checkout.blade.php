@extends('layouts.order-layout')

@section('content')
  <form name="refreshForm">
    <input type="hidden" name="visited" value="" />
  </form>


  <div class="order-container">

    <div class="cont-ord-left">

      <div id="order-survey">

        <div class="order-survey-box-left">

          <form action="{{ route('order-store') }}" method="post">
            @csrf
            @method('POST')

            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif

            @foreach ($data_array['plates'] as $key => $item)

              <input type="hidden" name='plate_{{$key +1}}' value='{{$item}}'>

            @endforeach

            <h1>Compila il form per ricevere l'ordine:</h1>

            <div class="form-order-bg">

              <div class="separate-survey">

                <label for="first_name"><h4>Nome</h4> </label>
                <br>
                <input type="text" name="first_name" value="" required minlength="2" placeholder="nome" maxlength="20">

              </div>

              <div class="separate-survey">

                <label for="last_name"><h4>Cognome</h4> </label>
                <br>
                <input type="text" name="last_name" value=""  required minlength="2" maxlength="20" placeholder="cognome">

              </div>

              <div class="separate-survey">

                <label for="email"><h4>Email</h4> </label>
                <br>
                <input type="email" name="email" value="" required minlength="5"  size="" placeholder="sophie@example.com" maxlength="50">

              </div>

              <div class="separate-survey">

                <label for="phone"><h4>Recapito telefonico</h4> </label>
                <br>
                <input type="" name="phone" value="" required placeholder="ex. 3389098234" minlength="6" maxlength="30">

              </div>

              <div class="separate-survey">

                <label for="comment"><h4>Commenti</h4> </label>
                <br>
                <input type="text" name="comment" value="" minlength="2" maxlength="50" placeholder="commento">

              </div>

              <div class="separate-survey">

                <label for="address"><h4>Indirizzo</h4> </label>
                <br>
                <input type="text" name="address" value="" required minlength="6" placeholder="indirizzo" maxlength="30">

              </div>
              <div class="but-cont-max">

                <div class="separate-survey-but">

                  <a href="{{ route('restaurant-show', $data_array['plateselect'] -> user_id)}}">
                    <input type="button" id="back-order-checkout" value="INDIETRO">
                  </a>

                </div>
                <div class="separate-survey-but">

                  <input type="submit" id="submit-order-checkout" value="SALVA">

                </div>
              </div>


            </form>


            </div>




        </div>

        <div class="order-survey-box-right">

          <div class="box-wrapper">
            <div class="basket-hover">

              <div class="basket_header">
                <span>Carrello</span>
              </div>

              <div class="basket-summary">


                @foreach ($data_array['plates'] as $item)
                  @if (count($data_array['plates']) <= 1)
                    <ul>
                      <li>Piatto: {{$item -> plate_name}}</li>
                      <li>Prezzo: {{$item -> price}} €</li>
                    </ul>
                  @elseif ($loop -> last)
                    <ul>

                      <li>Piatto: {{$item -> plate_name}}</li>
                      <li>Prezzo: {{$item -> price}} €</li>

                    </ul>
                  @else
                    <ul>
                      <li>Piatto: {{$item -> plate_name}}</li>
                      <li>Prezzo: {{$item -> price}} €</li>
                      <i class="fas fa-plus"></i>
                    </ul>
                  @endif

                @endforeach
                <i class="fas fa-plus"></i>
                <h4>costo consegna: {{$data_array['delivery']}} €</h4>
                <i class="fas fa-equals"></i>
                <h4>Totale da pagare: {{$data_array['topay'] + $data_array['delivery']}} €</h4>

              </div>
            </div>

          </div>



        </div>



      </div>

    </div>

  </div>



@endsection
