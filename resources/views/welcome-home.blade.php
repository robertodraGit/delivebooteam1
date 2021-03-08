@extends('layouts.layout-welcome')

@section('content')

    {{-- MAIN --}}
    <main>

        <div class="container">

            <slider></slider>

            {{-- lista ristoranti --}}
          <section v-if="displayRestaurants">
              <h1>Restaurants</h1>

              <div class="restaurants">

                <div  v-for="restaurant in restaurants" :key="restaurant.id">
                    {{-- <p>@{{restaurant}}</p> --}}
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
                  <div class="plate_container">
                    <a href="#">
                      <section v-if="plate.img != null" class="img" :style="{'background-image':'url(' + '/storage/plates/' + plate.img + ')'}"></section>
                      <div v-else class="img" :style="{'background-image':'url(' + '/storage/placeholder.svg' + ')'}"></div>

                      <section class="description">
                        <h2 class="title">@{{plate.plate_name}}</h2>
                      </section>
                    </a>
                  </div>
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
