<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

    <div class="flex flex-col sm:flex-row sm:items-center gap-3 text-sm text-gray-600">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                class="hover:text-indigo-600 transition underline-offset-4 hover:underline">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <span class="hidden sm:inline text-gray-400">•</span>

            <a href="{{ route('register') }}"
            class="hover:text-indigo-600 transition underline-offset-4 hover:underline">
                {{ __('Not registered?') }}
            </a>
        </div>

        <x-primary-button class="self-start sm:self-auto">
            {{ __('Log in') }}
        </x-primary-button>

    </div>

    </form>
</x-guest-layout>
