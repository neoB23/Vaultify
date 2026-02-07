<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-black antialiased selection:bg-black selection:text-white dark:selection:bg-white dark:selection:text-black">
        <flux:header container class="border-b border-gray-100 bg-white dark:border-zinc-900 dark:bg-black h-20">
            <flux:sidebar.toggle class="lg:hidden mr-4" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="dark:invert h-8" />

            <flux:navbar class="-mb-px max-lg:hidden ml-8">
                <flux:navbar.item 
                    icon="layout-grid" 
                    :href="route('dashboard')" 
                    :current="request()->routeIs('dashboard')" 
                    wire:navigate
                    class="font-black uppercase text-[10px] tracking-[0.2em] !h-20 border-b-2 border-transparent data-[current]:border-black dark:data-[current]:border-white"
                >
                    {{ __('Overview') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-2 py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 opacity-50 hover:opacity-100" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
                
                <flux:tooltip :content="__('Repository')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden opacity-50 hover:opacity-100"
                        icon="lock-closed"
                        href="https://github.com/laravel/livewire-starter-kit"
                        target="_blank"
                        :label="__('Repository')"
                    />
                </flux:tooltip>
                
                <flux:tooltip :content="__('Documentation')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden opacity-50 hover:opacity-100"
                        icon="book-open"
                        href="https://laravel.com/docs/starter-kits#livewire"
                        target="_blank"
                        :label="__('Docs')"
                    />
                </flux:tooltip>
            </flux:navbar>

            <div class="ml-4 flex items-center border-l border-gray-100 dark:border-zinc-900 pl-6 h-10">
                <x-desktop-user-menu />
            </div>
        </flux:header>

        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-gray-100 bg-white dark:border-zinc-900 dark:bg-black">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate class="dark:invert" />
                <flux:sidebar.collapse />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('System Mainframe')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="font-black uppercase text-[10px] tracking-[0.2em]">
                        {{ __('Overview') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="lock-closed" href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="font-bold text-[10px] uppercase tracking-widest opacity-50">
                    {{ __('Repository') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open" href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="font-bold text-[10px] uppercase tracking-widest opacity-50">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        <main>
            {{ $slot }}
        </main>

        @fluxScripts
    </body>
</html>