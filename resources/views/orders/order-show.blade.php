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
    <a href="{{ route('pay')}}">ROTTA PER IL PAGAMENTO</a>
  </h1>




@endsection
