@extends('layouts.main-layout')

@section('section')

  <h1>Vorrei comparisse un elenco di ordini per magia:</h1>
  {{-- <h1><a style="color:white;" href="{{ route('order-create')  }}">Crea nuovo order</a></h1> --}}

  <h1><a href="{{ route('dashboard')  }}"> vai alla dashboard</a></h1>

  @foreach ($orders as $order)
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

      <br>
      <hr>
      <br>

      {{-- <span><a href="{{ route('order-edit', $order -> id) }}">MODIFICA</a></span>
      <span><a href="{{ route('order-delete', $order -> id) }}">CANCELLA</a></span> --}}
    </div>
  @endforeach

@endsection
