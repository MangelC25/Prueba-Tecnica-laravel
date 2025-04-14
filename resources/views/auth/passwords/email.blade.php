@extends('layouts.app')

@section('content')


<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-black to-gray-800">
    <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg shadow-sky-400 p-6">
        <h2 class="text-2xl font-bold text-center text-white mb-6">{{ __('Reset Password') }}</h2>
                                                                                                                                                                                                                                                                                                                                    
        @if (session('status'))
            <div class="bg-green-500 text-white text-sm rounded p-3 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">{{ __('Email Address') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    class="mt-1 block w-full px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @enderror">
                @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
