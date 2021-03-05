@extends('layouts.layout-welcome')

@section('content')

    {{-- MAIN --}}
    <main>

        <div class="container">
                   
            <slider></slider>         

          <section>
              <h1>Piatti</h1>

              <div class="restaurants">

                  {{-- @foreach ($restaurants as $restaurant) --}}
                  {{-- @php   
                      dd($restaurants);
                  @endphp --}}
                      {{-- <restaurant
                      :restaurant_data = {{ $restaurant }}>
                      </restaurant>
                  @endforeach --}}

                  @foreach ($plates as $plate)

                    {{-- @php  
                        dd($plates);
                    @endphp --}}

                    <plate
                    :plate_data = {{ $plate }}
                    >
                    </plate>

                @endforeach
              

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