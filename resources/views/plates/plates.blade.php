<header class="header-plate-ind">
    <h4>Benvenuto/a
        <span>{{$user -> name}}!</span>
    </h4>
    <a href="{{ route('index') }}">
        <img src="{{ asset('storage/img/deliveroo-logo.svg') }}" alt="">
    </a>
</header>

<section class="list-plate">
    <h3>Lista di tutti i tuoi piatti</h3>
    <div class="button-dashboard">
        <form class="" action="{{ route('dashboard') }}">
            <button type="button">Torna alla dashboard</button>
        </form>
    </div>
    <div class="dashboard_plate">
        @foreach ($user -> plates as $plate)
            @if ($plate -> destroyed != 1)
                <div class="card-plate">
                    @php
                    $url_img = "/storage/plates/" . $plate -> img;
                    @endphp
                    @if ($plate -> img !== null)
                        <div class="column-img" style="background-image: url({{ $url_img }})">
                        </div>
                    @endif
                    <div class="column-img" style="background-image: url({{ asset('/storage/placeholder.svg') }})">
                        <h5>Nessuna immagine disponibile</h5>
                    </div>

                    <div class="list-column">
                        <p>Nome piatto: {{$plate -> plate_name}}</p>

                        <p>Ingredienti: {{$plate -> ingredients}}</p>

                        <p>Descrizione: {{$plate -> description}}</p>

                        <p>Prezzo: {{($plate -> price) / 100}}€</p>

                        <p>Sconto: {{$plate -> discount}}%</p>

                        <div class="checked-box">
                            <p>Visibile</p>
                            @if ($plate -> visible)
                                <input type="checkbox" disabled="disabled" checked>
                            @else
                                <input type="checkbox" disabled="disabled">
                            @endif
                        </div>

                        <div class="checked-box">
                            <p>Disponibile</p>
                            @if ($plate -> availability)
                                <input type="checkbox" disabled="disabled" checked>
                            @else
                                <input type="checkbox" disabled="disabled">
                            @endif
                        </div>


                        <p>Categoria:
                        @if ($plate -> category)
                            {{$plate -> category -> category}}
                        @endif
                        </p>

                    </div>

                    <div class="button-plate">
                        <form action="{{ route('plates-edit', $plate -> id) }}">
                            <button id="edit-button" type="submit">
                                Modifica piatto
                            </button>
                        </form>
                        <form action="{{ route('delete-plate', $plate -> id) }}">
                            <button id="delete-button" type="submit">
                                Elimina piatto
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
