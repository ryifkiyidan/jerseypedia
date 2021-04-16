<?php

use Illuminate\Support\Facades\Route;

?>
<nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Jersey<b>Pedia</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'home') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}"><?= (strpos(Route::currentRouteName(), 'home') === 0) ? '<b>Home</b>' : 'Home'; ?></a>
                </li>
                <li class="nav-item dropdown {{ (strpos(Route::currentRouteName(), 'products') === 0) ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= (strpos(Route::currentRouteName(), 'products') === 0) ? '<b>List Jersey</b>' : 'List Jersey'; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($ligas as $liga)
                        <a class="dropdown-item" href="{{ route('products.liga', $liga->id) }}">{{$liga->nama}}</a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('products') }}" class="dropdown-item">Semua Liga</a>
                    </div>
                </li>
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'history') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('history') }}"><?= (strpos(Route::currentRouteName(), 'history') === 0) ? '<b>History</b>' : 'History'; ?></a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'keranjang') === 0 || strpos(Route::currentRouteName(), 'checkout') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('keranjang') }}">
                        <?= (strpos(Route::currentRouteName(), 'keranjang') === 0 || strpos(Route::currentRouteName(), 'checkout') === 0) ? '<b>Keranjang</b>' : 'Keranjang'; ?>
                        <i class="fad fa-shopping-bag"></i>
                        @if ($jumlah_pesanan > 0)
                        <span class="badge badge-danger">{{ $jumlah_pesanan }}</span>
                        @endif
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'login') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}"><?= (strpos(Route::currentRouteName(), 'login') === 0) ? '<b>Login</b>' : 'Login'; ?></a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item {{ (strpos(Route::currentRouteName(), 'register') === 0) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}"><?= (strpos(Route::currentRouteName(), 'register') === 0) ? '<b>Register</b>' : 'Register'; ?></a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    </div>
</nav>
