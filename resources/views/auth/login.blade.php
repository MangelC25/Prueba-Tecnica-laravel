@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center  bg-gradient-to-br from-gray-900 via-black to-gray-800 text-gray-100">
    <div class="max-w-md w-full bg-gray-800 shadow-2xl shadow-sky-400 rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-4">
            <h2 class="text-2xl font-bold text-center">{{ __('Login') }}</h2>
        </div>
        <div class="px-6 py-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full bg-gray-700 border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full bg-gray-700 border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 flex items-center">
                    <input class="mr-2 leading-tight focus:ring-2 focus:ring-blue-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="text-sm" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-purple-600 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="text-blue-400 hover:text-blue-500 text-sm" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
