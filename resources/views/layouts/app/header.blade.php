<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 antialiased">
        <flux:header container class="border-b border-zinc-200/70 bg-white dark:border-zinc-800 dark:bg-zinc-900 h-16">
            <flux:sidebar.toggle class="lg:hidden mr-4" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden ml-8">
                <flux:navbar.item 
                    icon="home" 
                    :href="route('dashboard')" 
                    :current="request()->routeIs('dashboard')" 
                    wire:navigate
                >
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item 
                    icon="key" 
                    :href="route('passwords.index')" 
                    :current="request()->routeIs('passwords.*')" 
                    wire:navigate
                >
                    {{ __('Stored Passwords') }}
                </flux:navbar.item>
                <flux:navbar.item 
                    icon="shield-check" 
                    :href="route('account.security')" 
                    :current="request()->routeIs('account.*')" 
                    wire:navigate
                >
                    {{ __('Security') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <div class="flex items-center">
                <x-desktop-user-menu />
            </div>
        </flux:header>

        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200/70 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Menu')">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="key" :href="route('passwords.index')" :current="request()->routeIs('passwords.*')" wire:navigate>
                        {{ __('Stored Passwords') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="shield-check" :href="route('account.security')" :current="request()->routeIs('account.*')" wire:navigate>
                        {{ __('Security') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="cog-6-tooth" :href="route('profile.edit')" wire:navigate>
                    {{ __('Settings') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        <main>
            {{ $slot }}
        </main>

        @fluxScripts
    </body>
</html>