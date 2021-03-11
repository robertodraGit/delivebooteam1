@extends('layouts.layout-dashboard')

@section('content')

    <div class="container-dashboard">

        <div class="left-side-dash">
            @if (Auth::user() -> photo)
                <div class="img-user" style="background-image: url({{ asset('/storage/restaurant_icon/' . Auth::user() -> photo) }})">
                </div>
            @else
                <div class="img-user" style="background-image: url({{ asset('storage/user.svg') }})">
                </div>
            @endif
            <h1>
                {{ Auth::user() -> name }}
            </h1>

            <form action="{{ route('plates-create') }}">
                <button id="pls-plate" type="submit">
                    <i class="fas fa-plus"></i>
                    Aggiungi un nuovo piatto
                </button>
            </form>



            <div class="buttons-left-dash">
                <h4>Dashboard</h4>

                <form action="{{ route('dashboard') }}">
                    <button class="btn btn-success" type="submit">
                        Torna alla dashboard
                        <span class="plate-color"></span><span class="plate-color"></span><span class="plate-color"></span><span class="plate-color"></span>
                    </button>
                </form>
                
                <form action="{{ route('restaurant-edit') }}">
                    <button class="btn btn-success" type="submit">
                        Modifica il tuo profilo
                        <span class="plate-color"></span><span class="plate-color"></span><span class="plate-color"></span><span class="plate-color"></span>
                    </button>
                </form>

                <form action="{{ route('plates-index') }}">
                    <button class="btn btn-success" type="submit">
                        Visualizza i tuoi piatti
                        <span class="plate-color"></span><span class="plate-color"></span><span class="plate-color"></span><span class="plate-color"></span>
                    </button>
                </form>

                <form class="" action="{{ route('restaurant-order') }}">
                    <button>
                        Visualizza i tuoi ordini
                        <span class="order-color"></span><span class="order-color"></span><span class="order-color"></span><span class="order-color"></span>
                    </button>
                </form>
                <form class="" action="{{ route('stats') }}">
                    <button 
                        @if (empty($orders_3))
                            disabled
                        @endif
                    >
                        Statistiche ordini
                        <span class="order-color"></span><span class="order-color"></span><span class="order-color"></span><span class="order-color"></span>
                    </button>
                </form>
                <a
                    class="btn btn-danger"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>

        <div class="right-side-dash">

            @if (!empty($feedbacksOrder))
                <div class="card-2">
                    @foreach ($feedbacksOrder as $fb)
                        
                        <div class="mini-card">
                            <h4>{{$fb -> name}}</h4>
                            <h5>{{$fb -> email}}</h5>
                            <h1>{{$fb -> rate}}</h1>
                            <p>{{$fb -> comment}}</p>
                        </div>

                    @endforeach
                </div>
            @else
                <div class="card-2">
                    <div class="mini-card">
                        <h4>Al momento non ci sono feedback</h4>
                    </div>
                </div>
            @endif

            {{-- CONTAINER PRINCIPALE DELLE CARD --}}
                {{-- CARD ORDER--}}
                <div class="card-2">
                    @foreach ($feedbacksOrder as $fb)
                        
                        <div class="mini-card">
                            <h4>{{$fb -> name}}</h4>
                            <h5>{{$fb -> email}}</h5>
                            <h1>{{$fb -> rate}}</h1>
                            <p>{{$fb -> comment}}</p>
                        </div>

                    @endforeach
                </div>

        </div>

    </div>

@endsection
