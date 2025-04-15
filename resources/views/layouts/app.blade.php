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

<body class="antialiased min-h-screen bg-no-repeat bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white">
    <div id="app">
        <!-- Navegación -->
        <nav class="bg-gradient-to-r from-black to-sky-500 shadow-lg shadow-sky-400 relative ">
            <div class="container mx-auto px-4 py-4 flex items-center justify-between h-20">
                <a href="{{ url('/') }}" class="text-2xl font-extrabold text-white tracking-wide">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!-- Botón de menú para móvil -->
                <button type="button" id="menu-toggle"
                    class="md:hidden focus:outline-none p-2 rounded-full bg-black bg-opacity-20 hover:bg-opacity-40 transition duration-300 ease-in-out">
                    <!-- Icono del menú -->
                    <svg id="icon-hamburger" class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
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
                            <!-- Icono de Casa -->
                            <li
                                class="relative bg-black bg-opacity-20 rounded-full p-2 shadow-lg hover:bg-opacity-40 transition duration-300 ease-in-out transform hover:scale-110">
                                <a href="{{ route('cocktails.index') }}" title="Inicio"
                                    class="flex items-center p-2 hover:text-cyan-400 transition duration-300 ease-in-out transform hover:scale-110">
                                    <svg class="h-7 w-7 hover:drop-shadow-cyan-400 hover:drop-shadow-lg"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>

                                </a>
                            </li>
                            <!-- Icono de Maletín -->
                            <li
                                class="relative bg-black bg-opacity-20 rounded-full p-2 shadow-lg hover:bg-opacity-40 transition duration-300 ease-in-out transform hover:scale-110">
                                <a href="{{ route('cocktails.manage') }}" title="Gestión"
                                    class="flex items-center p-2 hover:text-purple-400 transition duration-300 ease-in-out transform hover:scale-110">
                                    <svg class="h-7 w-7 hover:drop-shadow-purple-400 hover:drop-shadow-lg"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>

                                </a>
                            </li>
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
            <div id="mobile-menu"
                class="md:hidden overflow-hidden max-h-0 transition-all duration-300 ease-in-out position absolute top-18 left-0 w-full shadow-lg bg-black/30 backdrop-blur-sm z-10">
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
                        <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 hover:shadow-lg hover:shadow-red-500/80 transition duration-300"
                            href="{{ route('cocktails.index') }}">Inicio</a>
                        <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 hover:shadow-lg hover:shadow-red-500/80 transition duration-300"
                            href="{{ route('cocktails.manage') }}">Gestionar Bebidas</a>
                        <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 hover:shadow-lg hover:shadow-red-500/80 transition duration-300"
                            href="#">{{ Auth::user()->name }}</a>
                        <a class="block text-white font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-black to-gray-500 hover:from-red-800 hover:to-black shadow-lg transform hover:scale-105 hover:shadow-lg hover:shadow-red-500/80 transition duration-300"
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
        <footer class="bg-gray-900 hidden text-center py-6 fixed bottom-0 w-full">
            <p class="text-gray-400">
                &copy; 2023 Cocktail Collection. All rights reserved.
            </p>
        </footer>
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
