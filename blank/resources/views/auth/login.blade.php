<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Log In') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        {{csrf_field()}}

        <!-- Student Number -->
        <div>
            <x-input-label for="s_number" :value="__('S_Number')" />
            <x-text-input id="s_number" class="block mt-1 w-full" type="text" name="s_number" :value="old('s_number')" required autofocus />
            <x-input-error :messages="$errors->get('s_number')" class="mt-2" />
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

        <!-- Forgot Password and Log In -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in to your account') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Register Section -->
    <div class="flex justify-between items-center mt-6">
        <span class="text-gray-600">{{ __('Don’t have an account?') }}</span>
        <a href="{{ route('register') }}" class="underline text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Create a new account') }}
        </a>
    </div>
</x-guest-layout>
