<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Reset your password')" :description="__('Enter your email and we\'ll send you a reset link')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
            @csrf

            <flux:input
                name="email"
                :label="__('Email')"
                type="email"
                required
                autofocus
                :placeholder="__('you@example.com')"
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                {{ __('Send reset link') }}
            </flux:button>
        </form>

        <div class="text-center text-sm text-zinc-500 dark:text-zinc-400">
            {{ __('Remember your password?') }}
            <flux:link :href="route('login')" wire:navigate>{{ __('Back to sign in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
