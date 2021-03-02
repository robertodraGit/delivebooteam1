@extends('layouts.main-layout')

@section('content')

  <h1>Vorrei comparisse un elenco di ordini per magia:</h1>

  <h1><a href="{{ route('dashboard')  }}">Vai alla dashboard</a></h1>

  <br><br>

  <ul>
    @foreach ($user -> plates as $plate)

      @foreach ($plate -> orders as $order)

        <li>
          <div>
            {{ $order -> id }} -
            {{ $order -> first_name }}
            {{ $order -> last_name }} <br>
            {{ $order -> email }} <br>
            {{ $order -> phone }} <br>
            {{ $order -> comment }} <br>
            {{ $order -> address }} <br>
            {{ $order -> email }} <br>
            Total: {{ ($order -> total_price) / 100 }} € <br>
            Orario ordine: {{ $order -> created_at }} <br>
            Stato pagamento: @if ($order -> payment_state = 1)
                Pagato
            @else
                Rifiutato
            @endif
            <br>
            TASTO DA ABORTIRE:
            <a href="{{ route('order-show', $order -> id) }}"> PAGA </a>

          </div>
        </li>
        <br>


      @endforeach

    @endforeach
  </ul>


  {{-- @foreach ($orders as $order)
    <div class="order">
      <a href="{{ route('order-show', $order -> id) }}">
        <h2 class="nome">
          Nome: {{$order -> first_name}}
        </h2>
        <h2>
          cognome: {{$order -> last_name}}
        </h2>
        <h2>
          mail: {{$order -> email}}
        </h2>
        <h2>
          phone: {{$order -> phone}}
        </h2>
        <h2>
          total price: {{$order -> total_price}} €
        </h2>

      </a>
    </div>
  @endforeach --}}

@endsection
