@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 antialiased">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200/70 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <flux:sidebar.header class="mb-4">
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Menu')">
                    <flux:sidebar.item 
                        icon="home" 
                        :href="route('dashboard')" 
                        :current="request()->routeIs('dashboard')" 
                        wire:navigate
                    >
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item 
                        icon="key" 
                        :href="route('passwords.index')" 
                        :current="request()->routeIs('passwords.*')" 
                        wire:navigate
                    >
                        {{ __('Stored Passwords') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item 
                        icon="shield-check" 
                        :href="route('account.security')" 
                        :current="request()->routeIs('account.*')" 
                        wire:navigate
                    >
                        {{ __('Security') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item
                    icon="cog-6-tooth"
                    :href="route('profile.edit')"
                    wire:navigate
                >
                    {{ __('Settings') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            {{-- Dark mode toggle --}}
            <div
                class="px-3 pb-2"
                x-data="{
                    cycle() {
                        const modes = ['light', 'dark', 'system'];
                        const i = modes.indexOf($flux.appearance);
                        $flux.appearance = modes[(i + 1) % modes.length];
                    }
                }"
            >
                <button
                    type="button"
                    @click="cycle()"
                    class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-zinc-500 hover:bg-zinc-800/5 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-white/7 dark:hover:text-white transition-colors"
                >
                    <template x-if="$flux.appearance === 'light'">
                        <flux:icon.sun variant="outline" class="size-5" />
                    </template>
                    <template x-if="$flux.appearance === 'dark'">
                        <flux:icon.moon variant="outline" class="size-5" />
                    </template>
                    <template x-if="$flux.appearance === 'system'">
                        <flux:icon.computer-desktop variant="outline" class="size-5" />
                    </template>
                    <span x-text="$flux.appearance === 'light' ? '{{ __('Light') }}' : ($flux.appearance === 'dark' ? '{{ __('Dark') }}' : '{{ __('System') }}')"></span>
                </button>
            </div>

            <div class="p-4 border-t border-zinc-200/70 dark:border-zinc-800">
                <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
            </div>
        </flux:sidebar>

        <flux:header class="lg:hidden bg-white dark:bg-zinc-900 border-b border-zinc-200/70 dark:border-zinc-800 px-6">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-2 text-sm">
                            <div class="flex items-center gap-2 px-1 py-1.5">
                                <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                                <div class="grid flex-1 leading-tight">
                                    <span class="text-sm font-medium text-zinc-900 dark:text-white truncate">{{ auth()->user()->name }}</span>
                                    <span class="text-xs text-zinc-500 truncate">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.item :href="route('profile.edit')" icon="cog-6-tooth" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                    {{-- Dark mode toggle --}}
                    <div
                        class="px-2 py-1"
                        x-data="{
                            cycle() {
                                const modes = ['light', 'dark', 'system'];
                                const i = modes.indexOf($flux.appearance);
                                $flux.appearance = modes[(i + 1) % modes.length];
                            }
                        }"
                    >
                        <button
                            type="button"
                            @click="cycle()"
                            class="flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-white/5 transition-colors"
                        >
                            <template x-if="$flux.appearance === 'light'">
                                <flux:icon.sun variant="outline" class="size-4" />
                            </template>
                            <template x-if="$flux.appearance === 'dark'">
                                <flux:icon.moon variant="outline" class="size-4" />
                            </template>
                            <template x-if="$flux.appearance === 'system'">
                                <flux:icon.computer-desktop variant="outline" class="size-4" />
                            </template>
                            <span x-text="$flux.appearance === 'light' ? '{{ __('Light') }}' : ($flux.appearance === 'dark' ? '{{ __('Dark') }}' : '{{ __('System') }}')"></span>
                        </button>
                    </div>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Sign out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>