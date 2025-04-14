<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/main.jsx'])
</head>

<body class="antialiased bg-gray-100">
    <div id="app">
        <!-- Navegación -->
        <nav class="bg-gradient-to-r from-black to-sky-500 shadow-lg relative ">
            <div class="container mx-auto px-4 py-4 flex items-center justify-between h-20">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-white tracking-wide">
                {{ config('app.name', 'Laravel') }}
            </a>
            <!-- Botón de menú para móvil -->
            <button type="button" id="menu-toggle"
                class="md:hidden focus:outline-none p-2 rounded-full bg-black bg-opacity-20 hover:bg-opacity-40 transition duration-300 ease-in-out">
                <!-- Icono del menú -->
                <svg id="icon-hamburger" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <!-- Ícono de X -->
                <svg id="icon-close" class="w-6 h-6 text-white hidden" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <!-- Menú principal -->
            <div class="hidden md:flex items-center space-x-8">
                <ul class="flex space-x-6 items-center">
                <!-- Enlaces izquierdo (si los hay) -->
                </ul>
                <!-- Autenticación -->
                <ul class="flex space-x-6 items-center">
                @guest
                    @if (Route::has('login'))
                    <li>
                        <a class="text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 shadow-lg transform hover:scale-105 transition duration-300"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li>
                        <a class="text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 shadow-lg transform hover:scale-105 transition duration-300"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                @else
                    <li class="relative">
                    <button id="user-menu-button"
                        class="flex items-center text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 transition duration-300 focus:outline-none cursor-pointer">
                        {{ Auth::user()->name }}
                        <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="user-dropdown"
                        class="absolute right-0 mt-2 w-48 bg-white bg-opacity-90 border rounded-lg shadow-lg py-2 hidden ">
                        <a class="block px-4 py-2 text-gray-800 hover:bg-gray-300 rounded-md transition duration-300"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                        </form>
                    </div>
                    </li>
                @endguest
                </ul>
            </div>
            </div>
            <!-- Menú móvil -->
            <div id="mobile-menu" class="md:hidden overflow-hidden max-h-0 transition-all duration-300 ease-in-out position absolute top-18 left-0 w-full shadow-lg bg-black/30 backdrop-blur-sm z-10">
            <div class="px-4 pt-3 pb-4 space-y-2 bg-black-100 text-white fill-opacity-90 rounded-lg shadow-lg ">
                @guest
                @if (Route::has('login'))
                    <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 shadow-lg transform hover:scale-105 transition duration-300"
                    href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
                @if (Route::has('register'))
                    <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 shadow-lg transform hover:scale-105 transition duration-300"
                    href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                @else
                <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 transition duration-300"
                    href="#">{{ Auth::user()->name }}</a>
                <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 transition duration-300"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                @endguest
            </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts para interactividad -->
    <script>
        // Toggle menú móvil
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');

        menuToggle.addEventListener('click', () => {
            if (mobileMenu.classList.contains('max-h-0')) {
                mobileMenu.classList.remove('max-h-0');
                mobileMenu.classList.add('max-h-screen');
                iconHamburger.classList.add('hidden');
                iconClose.classList.remove('hidden');
            } else {
                mobileMenu.classList.remove('max-h-screen');
                mobileMenu.classList.add('max-h-0');
                iconHamburger.classList.remove('hidden');
                iconClose.classList.add('hidden');
            }
        });

        // Dropdown de usuario
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');
        if (userMenuButton) {
            userMenuButton.addEventListener('click', () => {
                userDropdown.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>
