@extends('layouts.layout-dashboard')

@section('dashboard-comanda')
  <section class="section-comanda">
    <h1>Ordine id: {{$order -> id}}</h1>
    <div class="button-dashboard">
      <form class="" action="{{ route('restaurant-order') }}">
          <button type="submit">Torna agli ordini</button>
      </form>
    </div>

    <ul class="comanda-plates">
      @foreach ($order -> plates as $plate)
        <li>
          <div class="comanda-plate">
            <p class="plate-title">{{$plate -> plate_name}}</p>
            <p>{{$plate -> ingredients}}</p>
          </div>
        </li>
      @endforeach
    </ul>
  </section>
@endsection
