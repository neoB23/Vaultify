<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-black antialiased selection:bg-black selection:text-white dark:selection:bg-white dark:selection:text-black">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-gray-100 bg-white dark:border-zinc-900 dark:bg-black">
            <flux:sidebar.header class="mb-6">
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate class="dark:invert" />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('System Mainframe')" class="grid gap-1">
                    <flux:sidebar.item 
                        icon="home" 
                        :href="route('dashboard')" 
                        :current="request()->routeIs('dashboard')" 
                        wire:navigate
                        class="font-black uppercase text-[10px] tracking-[0.2em] hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all"
                    >
                        {{ __('Overview') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item 
                    icon="lock-closed" 
                    href="https://github.com/laravel/livewire-starter-kit" 
                    target="_blank"
                    class="font-bold text-[10px] uppercase tracking-widest opacity-50 hover:opacity-100 transition-opacity"
                >
                    {{ __('Repository') }}
                </flux:sidebar.item>

                <flux:sidebar.item 
                    icon="book-open" 
                    href="https://laravel.com/docs/starter-kits#livewire" 
                    target="_blank"
                    class="font-bold text-[10px] uppercase tracking-widest opacity-50 hover:opacity-100 transition-opacity"
                >
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <div class="p-4 border-t border-gray-100 dark:border-zinc-900">
                <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
            </div>
        </flux:sidebar>

        <flux:header class="lg:hidden bg-white dark:bg-black border-b border-gray-100 dark:border-zinc-900 px-6">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" />
                <flux:menu class="bg-white dark:bg-zinc-950 border-2 border-black dark:border-white">
                    <flux:menu.radio.group>
                        <div class="p-2 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start">
                                <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                                <div class="grid flex-1 text-start leading-tight">
                                    <flux:heading class="truncate text-[10px] font-black uppercase">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate text-[8px] font-bold opacity-50">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="text-[10px] font-black uppercase tracking-widest">
                        {{ __('Settings') }}
                    </flux:menu.item>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="power" class="w-full text-[10px] font-black uppercase tracking-widest text-red-600 hover:bg-red-600 hover:text-white">
                            {{ __('Logout') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>