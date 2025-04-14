@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 text-white px-6 py-4">
            <h2 class="text-lg font-semibold">{{ __('Register') }}</h2>
        </div>
        <div class="px-6 py-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm mb-2">{{ __('Name') }}</label>
                    <input id="name" type="text" class="w-full border border-gray-300 px-3 py-2 rounded @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full border border-gray-300 px-3 py-2 rounded @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full border border-gray-300 px-3 py-2 rounded @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="block text-gray-700 text-sm mb-2">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="w-full border border-gray-300 px-3 py-2 rounded" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
