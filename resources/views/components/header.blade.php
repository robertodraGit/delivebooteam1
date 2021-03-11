{{-- HEADER --}}
<header id="header-search">
  <div class="header-container-welcome">

    <div class="flex-container-header">
  
        {{-- menu --}}
          <ham-menu
              :welcome = "'{{ route("index") }}'"
              :login = "'{{ route("login") }}'"
              :register = "'{{ route("register") }}'"
              :dashboard = "'{{ route("dashboard") }}'"
              :logout = "'{{ route("logout") }}'"
              :user = "'{{ Auth::user() }}'"
              
              {{-- status --}}
              :welcome_s = "'{{Request::routeIs('index')}}'"
              :login_s = "'{{Request::routeIs('login')}}'"
              :register_s = "'{{Request::routeIs('register')}}'"
              :dashboard_s = "'{{Request::routeIs('dashboard')}}'"
              >
          </ham-menu>
    
        @include('components.search-bar')
  
        {{-- cart --}}
        {{-- <a href="#" class="cart">
            <svg height="24" width="24" viewBox="0 0 24 24">
                <path d="M14 15V13H10V15H14ZM15 15H19.1872L19.7172 13H15V15ZM14 12V10H15V12H19.9822L20.5122 10H3.48783L4.01783 12H9V10H10V12H14ZM14 18V16H10V18H14ZM15 18H18.3922L18.9222 16H15V18ZM9 15V13H4.28283L4.81283 15H9ZM9 18V16H5.07783L5.60783 18H9ZM7 8V3H17V8H23L20 20H4L1 8H7ZM9 8H15V5H9V8Z"></path>
            </svg>
        </a> --}}
  
        {{-- logo --}}
        <a href="{{route('index')}}" class="logo">
          <img src="{{asset('storage/img/deliveroo-logo.svg')}}" alt="">
      </a>
      
    </div>

  </div>
</header>
