@extends('layouts.layout-dashboard')

@section('content')

    <div class="container-dashboard">

        <div class="left-side-dash">
            <h2>Welcome</h2>

            <h1>User::auth()</h1>

            <div>
                <hr>
            </div>

            <h3>
                Al Gallo D'Oro
            </h3>

            <div class="buttons-left-dash">
                <button>
                    Modifica Dati
                </button>
                <button>
                    Visualizza Piatti
                </button>
                <button>
                   Visualizza Ordini
                </button>
                <button>
                    Statistiche Ordini
                </button>
                <button>
                    Logout
                </button>
            </div>
        </div>

        <div class="right-side-dash">
            <div class="header-right-dash">
                <button>
                    Aggiungi Piatto
                 </button>
                 <button>
                     Vai alla Homepage
                 </button>
            </div>

            <div class="last-order">
                <h2>
                    Ultimi ordini ricevuti
                </h2>

                {{-- CARD ORDINI --}}

                <div class="card-order">
                    <div class='card-relative'>

                        <div class="order-info">
                            <h3>
                                Pippo Ronaldo
                            </h3>
                            <hr>
                            <p>Status: pagato</p>
                            <p>Cellulare: 3333333</p>
                        </div>

                        <div class="right-card-order">
                            <div>
                                23,65 €
                            </div>
                            <div>
                                <button>Apri comanda</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-order">
                    <div class='card-relative'>

                        <div class="order-info">
                            <h3>
                                Pippo Ronaldo
                            </h3>
                            <hr>
                            <p>Status: pagato</p>
                            <p>Cellulare: 3333333</p>
                        </div>

                        <div class="right-card-order">
                            <div>
                                23,65 €
                            </div>
                            <div>
                                <button>Apri comanda</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-order">
                    <div class='card-relative'>

                        <div class="order-info">
                            <h3>
                                Pippo Ronaldo
                            </h3>
                            <hr>
                            <p>Status: pagato</p>
                            <p>Cellulare: 3333333</p>
                        </div>

                        <div class="right-card-order">
                            <div>
                                23,65 €
                            </div>
                            <div>
                                <button>Apri comanda</button>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- fine card ORDINI --}}

            </div>

            <div class="footer-dash">
                <div>
                    <button>
                        Visualizza tutti gli ordini
                    </button>
                </div>

                <div class="graph-chart-js">
                    grafici
                </div>
            </div>
        </div>

    </div>

@endsection