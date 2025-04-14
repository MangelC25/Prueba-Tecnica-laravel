@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 text-white px-6 py-4">
            <h2 class="text-lg font-semibold">{{ __('Login') }}</h2>
        </div>
        <div class="px-6 py-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full border border-gray-300 px-3 py-2 rounded @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full border border-gray-300 px-3 py-2 rounded @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 flex items-center">
                    <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="text-gray-700 text-sm" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="text-blue-500 hover:text-blue-700 text-sm" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
