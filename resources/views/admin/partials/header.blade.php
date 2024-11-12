<div class="container-fluid">
    <div class="row navbar navbar-light bg-white shadow-sm">

        {{-- logo del sito --}}
        <div class="col-8">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <div>
                    <img class="logo" src="{{ asset('images/FULL_LOGO.svg') }}" alt="">
                </div>
            </a>
        </div>

        <div class="col-4 text-end">
            <nav class="navbar navbar-expand-md justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Parte destra della navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- se l'utente non è registrato -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else

                        {{-- se è registrato --}}
                            <li class="nav-item dropdown">
                                {{-- nome dell'utente --}}
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                {{-- dropdown menu per dashboard - profilo - logout --}}
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>



            </nav>
        </div>
    </div>
</div>
