@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800">{{ __('Confirm Password') }}</h2>
        <p class="text-sm text-gray-600 text-center mt-2">{{ __('Please confirm your password before continuing.') }}</p>

        <form method="POST" action="{{ route('password.confirm') }}" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('password') @enderror">
                @error('password')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    {{ __('Confirm Password') }}
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="mt-4 text-center">
                    <a class="text-sm text-purple-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
