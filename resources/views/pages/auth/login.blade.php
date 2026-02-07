<x-layouts::auth>
    <div class="flex flex-col gap-8 items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
        <div class="w-full max-w-md p-8 bg-white dark:bg-neutral-900 rounded-2xl shadow-xl border border-neutral-200 dark:border-neutral-800">
            <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6 mt-6">
                @csrf

                <!-- Email Address -->
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500"
                />

                <!-- Password -->
                <div class="relative">
                    <flux:input
                        name="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Password')"
                        viewable
                        class="rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500"
                    />

                    @if (Route::has('password.request'))
                        <flux:link class="absolute top-0 text-sm end-0 text-blue-600 hover:underline" :href="route('password.request')" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </flux:link>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <flux:button variant="primary" type="submit" class="w-full py-3 text-lg font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 transition-colors shadow" data-test="login-button">
                        {{ __('Log in') }}
                    </flux:button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="mt-6 space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Don\'t have an account?') }}</span>
                    <flux:link :href="route('register')" wire:navigate class="text-blue-600 hover:underline">{{ __('Sign up') }}</flux:link>
                </div>
            @endif
        </div>
    </div>
</x-layouts::auth>
