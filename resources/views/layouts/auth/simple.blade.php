<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center p-6 md:p-10 relative">
            {{-- Ambient gradient background --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/5 dark:bg-emerald-500/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-teal-500/5 dark:bg-teal-500/5 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-cyan-500/3 dark:bg-cyan-500/3 rounded-full blur-3xl"></div>
            </div>

            <div class="flex w-full max-w-sm flex-col gap-8 relative z-10">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-4 group" wire:navigate>
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-linear-to-br from-emerald-600 to-teal-700 shadow-lg shadow-emerald-900/20 dark:shadow-emerald-500/10 transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl group-hover:shadow-emerald-900/30 dark:group-hover:shadow-emerald-500/20">
                        <x-app-logo-icon class="size-8 text-white" />
                    </div>
                    <span class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ config('app.name', 'Vaultify') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
