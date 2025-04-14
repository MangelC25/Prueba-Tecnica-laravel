@extends('layouts.app')

@section('content')
<div class="min-h-180 flex items-center justify-center px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-900 via-black to-gray-800 text-gray-100">
    <div class="w-full max-w-md bg-gradient-to-br from-purple-600 via-blue-500 to-indigo-600 shadow-2xl shadow-sky-400 rounded-2xl overflow-hidden transform hover:scale-102 transition-transform duration-300">
        <div class="text-white px-6 py-4 text-center">
            <h2 class="text-2xl font-bold tracking-wide">{{ __('Reset Password') }}</h2>
            <p class="text-sm opacity-75">{{ __('Enter your new password to reset your account') }}</p>
        </div>
        <div class="bg-white px-6 sm:px-8 py-6 text-gray-700">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:outline-none @error('email') border-red-500 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:outline-none @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password-confirm" class="block text-gray-700 text-sm font-medium mb-2">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:outline-none" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg transform hover:scale-102 transition duration-300 cursor-pointer">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
