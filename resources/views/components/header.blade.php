<header>
  {{-- INIZIO HEADER SX --}}
  <div class="header-sx">
    <div class="header-logo">
      <div class="logo-img">
        <a href="">
          <i class="fas fa-bars"></i>
        </a>
      </div>
  </div>
  {{-- FINE HEADER SX --}}
  {{-- INIZIO HEADER DX --}}
  </div>
  <div class="header-dx">
    <ul>
      <li>
        <a href="{{ route('home')}}">Home</a>
      </li>

      @auth
        {{-- qua andrà link per utente registrato --}}
      @endauth

        <!-- Authentication Links -->
        @guest
          <li id="login" class="nav-item">
              <a class="nav-link login-button" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
            <li class="register-button nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
            </li>
          @endif
          @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                </div>
            </li>
        @endguest
    </ul>
  </div>

</header>
