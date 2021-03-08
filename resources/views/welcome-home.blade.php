@extends('layouts.layout-welcome')

@section('content')

    {{-- MAIN --}}
    <main>

        <div class="container">

            {{-- <slider></slider> --}}

            {{-- lista ristoranti --}}
          <section v-if="displayRestaurants">
              <h1>Restaurants</h1>

              <div class="restaurants">

                <div  v-for="restaurant in restaurants" :key="restaurant.id">
                    <p>@{{restaurant}}</p>
                    <restaurant
                      :restaurant_data="restaurant"
                    ></restaurant>
                </div>

              </div>
          </section>

          <section v-if="displayPlates">
            <h1>Plates</h1>

            <div class="plates">

              <div v-for="plate in plates" :key="plate.id">
                  <p>Bozza del piatto: @{{plate.plate_name}}</p> 
              </div>

            </div>
          </section>

        </div>

    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <nav>
                <ul>
                    <li>Scopri deliveroo</li>
                    <li><a href="#">asdfghjkl</a></li>
                    <li><a href="#">asdfghjkl</a></li>
                    <li><a href="#">asdfghjkl</a></li>
                </ul>

                <ul>
                    <li>FAQ</li>
                    <li><a href="#">asdfghjkl</a></li>
                    <li><a href="#">asdfghjkl</a></li>
                    <li><a href="#">asdfghjkl</a></li>
                </ul>

                <ul>
                    <li>Aiuto</li>
                    <li><a href="#">asdfghjkl</a></li>
                    <li><a href="#">asdfghjkl</a></li>
                    <li><a href="#">asdfghjkl</a></li>
                </ul>

            </nav>

            <div class="copyright">copyright</div>
        </div>
    </footer>
@endsection
