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
        <nav class="bg-white shadow">
            <div class="container mx-auto px-4 py-3 flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!-- Botón de menú para móvil -->
                <button type="button" id="menu-toggle"
                    class="md:hidden focus:outline-none p-2 rounded-md hover:bg-gray-200 transition duration-150 ease-in-out">
                    <!-- Icono del menú -->
                    <svg id="icon-hamburger" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Ícono de X -->
                    <svg id="icon-close" class="w-6 h-6 text-gray-700 hidden" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Menú principal -->
                <div class="hidden md:flex items-center space-x-6 ">
                    <!-- Aquí podrías agregar más enlaces de navegación -->
                    <ul class="flex space-x-4 items-center">
                        <!-- Enlaces izquierdo (si los hay) -->
                    </ul>
                    <!-- Autenticación -->
                    <ul class="flex space-x-4 items-center">
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a class="text-gray-700 hover:text-gray-900"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li>
                                    <a class="text-gray-700 hover:text-gray-900"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="relative">
                                <button id="user-menu-button"
                                    class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="user-dropdown"
                                    class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg py-1 hidden">
                                    <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
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
            <div id="mobile-menu" class="md:hidden overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                <!-- Contenido del menú -->
                <div class="px-4 pt-2 pb-3 space-y-1 bg-white border-b border-gray-200 shadow">
                    <!-- Enlaces del menú -->
                    @guest
                        @if (Route::has('login'))
                            <a class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md w-full"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a class="block text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md"
                            href="#">{{ Auth::user()->name }}</a>
                        <a class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="py-6">
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
