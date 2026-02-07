<x-layouts::auth>
    <div class="flex flex-col gap-8 items-center justify-center min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
        <div class="w-full max-w-md p-8 bg-white dark:bg-neutral-900 rounded-2xl shadow-xl border border-neutral-200 dark:border-neutral-800">
            <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6 mt-6">
                @csrf
                <!-- Name -->
                <flux:input
                    name="name"
                    :label="__('Name')"
                    :value="old('name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                    class="rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500"
                />

                <!-- Email Address -->
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500"
                />

                <!-- Password -->
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                    class="rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500"
                />

                <!-- Confirm Password -->
                <flux:input
                    name="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                    class="rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500"
                />

                <div class="flex items-center justify-end mt-4">
                    <flux:button type="submit" variant="primary" class="w-full py-3 text-lg font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 transition-colors shadow" data-test="register-user-button">
                        {{ __('Create account') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::auth>
