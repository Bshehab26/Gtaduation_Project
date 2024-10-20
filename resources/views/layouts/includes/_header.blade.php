@php
$isUserOwner=false;
if(Auth::check()){
    $isUserOwner=DB::table('users')->where('id',Auth::user()->id)->exists();}
@endphp

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
                        {{ Auth::user()->fullName() }}
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

                        @if ($isUserOwner)
                        <a class="dropdown-item text-white"
                        href="{{ route('webusers.show', auth()->user()->id) }}"
                        >
                            Profile
                        </a>
                        <hr class="mx-auto" style="background-color: white; height:2px; width: 90%;">
                    @endif

                    @if ($isUserOwner)
                    <a class="dropdown-item text-white"
                    href="{{ route('webusers.edit', auth()->user()->id) }}"
                    >
                        EditProfile
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
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @if (Auth::check() && Auth::user()->role === 'admin')
        <a class="cta-btn d-none d-sm-block" href="{{ route('dashboard.events.create') }}">
            New event
        </a>
    @elseif (Auth::check() && Auth::user()->role === 'organizer')
        <a class="cta-btn d-none d-sm-block" href="{{ route('events.create') }}">
            New event
        </a>
    @endif

    </div>
  </header>
