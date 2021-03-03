@extends('layouts.main-layout')

@section('content')

  <div class="container-fluid">


    <div style="margin-top: 100px;" class="row">

      <div class="col-md-12">



      <form action="{{ route('order-store')}}" method="post">
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

        @foreach ($plates as $key => $plate)

          <label
            for="plate_id_{{$key}}"
          >
            {{$plate -> plate_name}}
          </label>

          <input type="checkbox"
            name="plate_id_{{$key}}"
            value="{{ $plate -> id }}"
          >
          {{-- <span>{{ $plat}}</span> --}}
          <br>

        @endforeach

        <label for="first_name">first_name: </label>
        <input type="text" name="first_name" value="">
        <br>
        <label for="last_name">last_name: </label>
        <input type="text" name="last_name" value="">
        <br>
        <label for="email">email: </label>
        <input type="text" name="email" value="">
        <br>
        <label for="phone">phone: </label>
        <input type="text" name="phone" value="">
        <br>
        <label for="comment">comment: </label>
        <input type="text" name="comment" value="">
        <br>
        <label for="address">address: </label>
        <input type="text" name="address" value="">
        <br>



        <br>
        <input type="submit" value="SALVA">

      </form>

      </div>

    </div>

  </div>





























@endsection
