<x-layouts::app :title="__('Dashboard')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- Welcome Header --}}
            <header class="mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">{{ __('Welcome back') }} 👋</p>
                        <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white tracking-tight">
                            {{ Auth::user()->name }}
                        </h1>
                    </div>
                    <a href="{{ route('passwords.create') }}"
                       class="group inline-flex items-center gap-2.5 h-11 px-6 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-2xl text-sm font-semibold hover:shadow-lg hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-90">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('Add Password') }}
                    </a>
                </div>
            </header>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
                {{-- Total --}}
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 p-5 hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center group-hover:bg-zinc-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-zinc-900 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /></svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $passwords->count() }}</p>
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mt-0.5">{{ __('Total Passwords') }}</p>
                </div>

                {{-- Favorites --}}
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 p-5 hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $passwords->where('favorite', true)->count() }}</p>
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mt-0.5">{{ __('Favorites') }}</p>
                </div>

                {{-- Encryption --}}
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 p-5 hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">AES-256</p>
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mt-0.5">{{ __('All Fields Encrypted') }}</p>
                </div>

                {{-- 2FA --}}
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 p-5 hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        @if(Auth::user()->hasEnabledTwoFactorAuthentication())
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        </div>
                        @else
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        </div>
                        @endif
                    </div>
                    <p class="text-sm font-bold {{ Auth::user()->hasEnabledTwoFactorAuthentication() ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600 dark:text-amber-400' }}">
                        {{ Auth::user()->hasEnabledTwoFactorAuthentication() ? __('Enabled') : __('Disabled') }}
                    </p>
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mt-0.5">{{ __('Two-Factor Auth') }}</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                {{-- Add Password --}}
                <a href="{{ route('passwords.create') }}"
                   class="group relative bg-linear-to-br from-zinc-900 via-zinc-800 to-zinc-900 dark:from-white dark:via-zinc-50 dark:to-white rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-zinc-900/20 dark:hover:shadow-white/20 hover:scale-[1.02] active:scale-[0.99] overflow-hidden">
                    <div class="absolute inset-0 bg-linear-to-br from-white/5 to-transparent dark:from-zinc-900/5"></div>
                    <div class="relative flex flex-col justify-between h-32">
                        <div class="h-11 w-11 rounded-xl bg-white/10 dark:bg-zinc-900/10 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white dark:text-zinc-900 transition-transform duration-300 group-hover:rotate-90">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-white dark:text-zinc-900">{{ __('New Password') }}</h3>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-0.5">{{ __('Add a new credential to your vault') }}</p>
                        </div>
                    </div>
                </a>

                {{-- View Passwords --}}
                <a href="{{ route('passwords.index') }}"
                   class="group bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200/80 dark:border-zinc-800 transition-all duration-300 hover:shadow-lg hover:border-zinc-300 dark:hover:border-zinc-700 hover:scale-[1.01]">
                    <div class="flex flex-col justify-between h-32">
                        <div class="h-11 w-11 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-300 group-hover:bg-zinc-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-zinc-900 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('All Passwords') }}</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $passwords->count() }} {{ __('credentials stored') }}</p>
                        </div>
                    </div>
                </a>

                {{-- Security --}}
                <a href="{{ route('account.security') }}"
                   class="group bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200/80 dark:border-zinc-800 transition-all duration-300 hover:shadow-lg hover:border-zinc-300 dark:hover:border-zinc-700 hover:scale-[1.01]">
                    <div class="flex flex-col justify-between h-32">
                        <div class="h-11 w-11 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-300 group-hover:bg-zinc-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-zinc-900 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Security') }}</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">{{ __('Account protection & 2FA') }}</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Recent Passwords --}}
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Recent Passwords') }}</h2>
                    @if($passwords->count() > 0)
                        <a href="{{ route('passwords.index') }}" class="text-xs font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-white transition-colors flex items-center gap-1">
                            {{ __('View all') }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </a>
                    @endif
                </div>

                @if($passwords->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($passwords->take(6) as $pw)
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 p-5 hover:shadow-lg hover:shadow-zinc-200/50 dark:hover:shadow-zinc-900/50 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300"
                             style="animation: fadeInUp 0.4s ease-out {{ $loop->index * 0.06 }}s both">
                            <div class="flex items-start gap-3.5">
                                <div class="shrink-0 h-11 w-11 rounded-xl bg-linear-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-700 flex items-center justify-center text-sm font-bold text-zinc-600 dark:text-zinc-300 shadow-sm">
                                    @if($pw->domain)
                                        <img src="https://www.google.com/s2/favicons?domain={{ $pw->domain }}&sz=32"
                                             alt="" class="w-5 h-5 rounded"
                                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <span style="display:none" class="text-sm font-bold">{{ $pw->initials }}</span>
                                    @else
                                        {{ $pw->initials }}
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-white truncate">{{ $pw->title }}</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate mt-0.5">{{ $pw->username }}</p>
                                </div>
                                @if($pw->favorite)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5 text-amber-400 shrink-0"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 mt-4 pt-3.5 border-t border-zinc-100 dark:border-zinc-800/60" x-data="{ copied: false }">
                                <span class="flex-1 text-xs text-zinc-400 dark:text-zinc-500 font-mono tracking-wider">••••••••••••</span>
                                <button @click="fetch('{{ route('passwords.reveal', $pw) }}', { headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(r => r.json()).then(d => { navigator.clipboard.writeText(d.password); copied = true; setTimeout(() => copied = false, 2000); })"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium transition-all duration-200"
                                    :class="copied ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9.75a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" /></svg>
                                    <span x-text="copied ? '{{ __("Copied!") }}' : '{{ __("Copy") }}'"></span>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 p-16 text-center">
                        <div class="relative inline-flex items-center justify-center mb-6">
                            <div class="absolute w-24 h-24 rounded-full bg-zinc-100/80 dark:bg-zinc-800/50 animate-pulse"></div>
                            <div class="relative h-16 w-16 rounded-2xl bg-linear-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-700 flex items-center justify-center shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-zinc-400 dark:text-zinc-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">{{ __('Your vault is empty') }}</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto mb-8">{{ __('Start securing your digital life. Add your first password and it will be encrypted automatically.') }}</p>
                        <a href="{{ route('passwords.create') }}"
                           class="inline-flex items-center gap-2.5 h-11 px-6 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-2xl text-sm font-semibold hover:shadow-lg active:scale-[0.97] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            {{ __('Add Your First Password') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts::app>