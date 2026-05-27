<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center">

                <div class="w-20 h-20 rounded-full bg-white shadow-md flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('assets/img/logo.png') }}"
                        alt="Logo"
                        class="w-full h-full object-cover">
                </div>

                <span class="mt-2 text-lg font-semibold text-gray-700">
                    ExpenseX
                </span>

            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 mb-5">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>


            <div class="flex items-center justify-between mt-5">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                    class="text-indigo-600 hover:text-indigo-900 font-medium">
                        Create one
                    </a>
                </p>

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
