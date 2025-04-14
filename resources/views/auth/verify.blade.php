@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 text-white px-6 py-4">
            <h2 class="text-lg font-semibold">{{ __('Verify Your Email Address') }}</h2>
        </div>
        <div class="px-6 py-4">
            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="mb-4 text-gray-700">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
            </p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    {{ __('click here to request another') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
