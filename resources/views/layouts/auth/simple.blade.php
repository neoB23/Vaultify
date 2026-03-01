<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center p-6 md:p-10 relative">
            {{-- Subtle background ambience --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-1/3 left-1/3 w-72 h-72 bg-zinc-200/20 dark:bg-zinc-800/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/3 right-1/3 w-64 h-64 bg-zinc-100/30 dark:bg-zinc-700/10 rounded-full blur-3xl"></div>
            </div>

            <div class="flex w-full max-w-sm flex-col gap-6 relative z-10">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-3 group" wire:navigate>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-900 dark:bg-white shadow-xl shadow-zinc-900/10 dark:shadow-white/10 transition-transform duration-200 group-hover:scale-105">
                        <x-app-logo-icon class="size-7 fill-current text-white dark:text-zinc-900" />
                    </div>
                    <span class="text-base font-bold text-zinc-900 dark:text-white tracking-tight">{{ config('app.name', 'PassHolder') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
