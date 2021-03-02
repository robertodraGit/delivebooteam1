@extends('layouts.main-layout')

@section('content')

  {{-- HOME - JUMBOTRON --}}
  <div class="jumbotron jumbotron-fluid">
    <div class="overlay"></div>
      <div class="container container-input center_home">
        <div class="row justify-content-center">
          <h1 class="display-4">
            Hai voglia di qualcosa in particolare?
          </h1>
        </div>
        {{-- JUMBOTRON - SEARCHBAR --}}
        <div class="input-group">
          <div class="filter">

            {{-- SEARCH - FORM --}}
            <form id="form-search" action="" method="get">
              {{-- @csrf
              @method('GET') --}}
              <div class="form-group">
                <div class="row flex-nowrap justify-content-space-between">
                  {{-- BARRA DI RICERCA --}}
                  <input type="search" class="form-control" id="home-search-bar"  name='search' placeholder="Cerca" value="">
                  {{-- SUBMIT --}}
                  <input type="submit" id="submit-home" class="btn bnb_btn" value='Cerca'>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>

  {{-- HOME - SECTION-PIATTI' --}}
  <div class="container-fluid" style="margin-bottom: 2rem;">
    <div class="row">
      <div class="col-md-10 offset-1">
        <div class="food-show-home">
          {{-- SPOT VUOTO --}}
          <div class="row">

              <div class="col-md-2">
                <img src="img/pizza.png" alt="">
              </div>
              <div class="col-md-2">
                <img src="img/kebab.png" alt="">
              </div>
              <div class="col-md-2">
                <img src="img/pizza.png" alt="">
              </div>
              <div class="col-md-2">
                <img src="img/kebab.png" alt="">
              </div>
              <div class="col-md-2">
                <img src="img/pizza.png" alt="">
              </div>
              <div class="col-md-2">
                <img src="img/dessert.png" alt="">
              </div>

          </div>
        </div>
      </div>
      {{-- FIX OFFSET --}}
      <div class="col-md-1"></div>

      <br>

      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">

            



          </div>

        </div>

      </div>




    </div>
  </div>

@endsection
