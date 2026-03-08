<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vaultify — Secure Password Manager</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white dark:bg-zinc-950 text-zinc-900 dark:text-white antialiased min-h-screen flex flex-col overflow-x-hidden">

        {{-- Navigation --}}
        <header class="w-full max-w-6xl mx-auto px-6 py-5 flex items-center justify-between relative z-10">
            <div class="flex items-center gap-2.5">
                <div class="h-9 w-9 rounded-xl bg-zinc-900 dark:bg-white flex items-center justify-center shadow-lg shadow-zinc-900/10 dark:shadow-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4.5 h-4.5 text-white dark:text-zinc-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                </div>
                <span class="text-lg font-bold tracking-tight">Vaultify</span>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="h-10 px-5 inline-flex items-center justify-center bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-xl text-sm font-semibold hover:shadow-lg hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">
                            {{ __('Log in') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="h-10 px-5 inline-flex items-center justify-center bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-xl text-sm font-semibold hover:shadow-lg hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all">
                                {{ __('Sign up free') }}
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- Hero Section --}}
        <main class="flex-1 flex items-center justify-center px-6 relative">
            {{-- Ambient Background --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-zinc-200/30 dark:bg-zinc-800/20 rounded-full blur-3xl animate-pulse" style="animation-duration: 6s"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-zinc-100/40 dark:bg-zinc-700/10 rounded-full blur-3xl animate-pulse" style="animation-duration: 8s; animation-delay: 2s"></div>
            </div>

            <div class="max-w-3xl mx-auto text-center py-16 relative z-10">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-zinc-100 dark:bg-zinc-800/80 border border-zinc-200/80 dark:border-zinc-700/50 text-xs font-medium text-zinc-600 dark:text-zinc-400 mb-8 backdrop-blur-sm">
                    <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                    {{ __('AES-256 Encrypted · All fields secured') }}
                </div>

                {{-- Hero icon --}}
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-3xl bg-linear-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-700 mb-8 shadow-xl shadow-zinc-200/50 dark:shadow-zinc-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-zinc-600 dark:text-zinc-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.1] mb-6">
                    {{ __('Your passwords,') }}<br>
                    <span class="bg-clip-text text-transparent bg-linear-to-r from-zinc-400 to-zinc-500 dark:from-zinc-500 dark:to-zinc-600">{{ __('safely stored.') }}</span>
                </h1>

                <p class="text-lg sm:text-xl text-zinc-500 dark:text-zinc-400 max-w-lg mx-auto mb-10 leading-relaxed">
                    {{ __('A simple, secure password manager. Keep all your credentials encrypted and accessible only to you.') }}
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="h-12 px-8 inline-flex items-center justify-center bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-2xl text-sm font-semibold hover:shadow-xl hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all">
                            {{ __('Go to Dashboard') }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="h-12 px-8 inline-flex items-center justify-center bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-2xl text-sm font-semibold hover:shadow-xl hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all">
                                {{ __('Get Started — It\'s Free') }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                            </a>
                        @endif
                        <a href="{{ route('login') }}"
                           class="h-12 px-8 inline-flex items-center justify-center border border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-300 rounded-2xl text-sm font-semibold hover:bg-zinc-50 dark:hover:bg-zinc-800 active:scale-[0.97] transition-all">
                            {{ __('Sign In') }}
                        </a>
                    @endauth
                </div>
            </div>
        </main>

        {{-- Features --}}
        <section class="w-full max-w-5xl mx-auto px-6 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-zinc-50/50 dark:bg-zinc-900/50 border border-zinc-200/60 dark:border-zinc-800/60 rounded-2xl p-6 text-center hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-emerald-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">{{ __('AES-256 Encryption') }}</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ __('Military-grade encryption on all fields — passwords, usernames, URLs, and notes.') }}</p>
                </div>

                <div class="bg-zinc-50/50 dark:bg-zinc-900/50 border border-zinc-200/60 dark:border-zinc-800/60 rounded-2xl p-6 text-center hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-blue-50 dark:bg-blue-500/10 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a48.667 48.667 0 0 0-1.488 8.877m5.152-8.627a3 3 0 0 1 5.502 1.5c0 1.627-.31 3.182-.876 4.607M12 10.5a48.578 48.578 0 0 0-1.097 9.014" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">{{ __('Two-Factor Auth') }}</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ __('Optional 2FA adds another layer of protection to your account.') }}</p>
                </div>

                <div class="bg-zinc-50/50 dark:bg-zinc-900/50 border border-zinc-200/60 dark:border-zinc-800/60 rounded-2xl p-6 text-center hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-amber-50 dark:bg-amber-500/10 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-amber-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">{{ __('Fast & Simple') }}</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ __('Clean interface designed for speed. Search, copy, and manage passwords instantly.') }}</p>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="w-full max-w-6xl mx-auto px-6 py-6 border-t border-zinc-100 dark:border-zinc-800/60">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-zinc-400 dark:text-zinc-600">&copy; {{ date('Y') }} Vaultify. {{ __('All rights reserved.') }}</p>
                <p class="text-xs text-zinc-400 dark:text-zinc-600 flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    {{ __('Secured with AES-256 encryption') }}
                </p>
            </div>
        </footer>
    </body>
</html>
