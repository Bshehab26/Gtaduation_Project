<header id="header" class="header d-flex align-items-center fixed-top p-0 flex-column" >

    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-end px-4 gap-4 fs-6 text-white w-100" style="background-color: #00000091; max-width: none;">
        @guest
            <a class="text-white py-2" href="{{ route('login') }}">Sign in</a>
            <a class="text-white py-2" href="{{ route('register') }}">Sign up</a>
        @else
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown"
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false" v-pre
                    >
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdown"
                    style="background-color: #000820;">

                        @if (Auth::user()->role === 'admin')
                            <a class="dropdown-item text-white"
                            href="{{ route('dashboard-home') }}"
                            >
                                Dashboard
                            </a>
                            <hr class="mx-auto" style="background-color: white; height:2px; width: 90%;">
                        @endif

                        <a class="dropdown-item text-white"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                        >
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endguest
    </div>

    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <img src="/assets/img/logo.png" alt="logo">
        <!-- Uncomment the line below if you also wish to use an text logo -->
        <!-- <h1 class="sitename">TheEvent</h1>  -->
      </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home<br></a>
            </li>
            {{-- <li>
                <a href="#speakers">Speakers</a>
            </li> --}}
            <li>
                <a href="{{ route('events.index') }}" class="{{ Route::is('events.*') ? 'active' : '' }}">Events</a>
            </li>
            <li>
                <a href="{{ route('venues-user.index') }}">Venue</a>
            </li>
            <li>
                <a href="#gallery">Gallery</a>
            </li>
            <li class="dropdown">
                <a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#">Dropdown 1</a></li>
                    <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Deep Dropdown 1</a></li>
                        <li><a href="#">Deep Dropdown 2</a></li>
                        <li><a href="#">Deep Dropdown 3</a></li>
                        <li><a href="#">Deep Dropdown 4</a></li>
                        <li><a href="#">Deep Dropdown 5</a></li>
                    </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
                </ul>
            </li>
            <li>
                <a href="#contact">Contact</a>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @if (Auth::check() && Auth::user()->role === 'admin')
        <a class="cta-btn d-none d-sm-block" href="{{ route('dashboard.events.create') }}">
            New event
        </a>
    @elseif (Auth::check() && Auth::user()->role === 'organizer')
        <a class="cta-btn d-none d-sm-block" href="{{ route('dashboard.events.create') }}">
            New event
        </a>
    @endif

    </div>
  </header>
