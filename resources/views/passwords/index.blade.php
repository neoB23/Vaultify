<x-layouts::app title="Passwords">
    <div class="py-6 px-4 sm:px-6 lg:px-8" x-data="passwordVault()" x-cloak>
        <div class="max-w-7xl mx-auto">

            {{-- Success Toast --}}
            @if(session('status'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                 class="fixed bottom-6 right-6 z-60 flex items-center gap-3 px-5 py-3.5 bg-emerald-600 text-white rounded-2xl shadow-2xl shadow-emerald-500/25 text-sm font-medium">
                <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                </div>
                {{ session('status') }}
            </div>
            @endif

            {{-- Copy / Action Toast (JS-driven) --}}
            <div id="action-toast" style="display:none"
                 class="fixed bottom-6 right-6 z-60 flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-2xl text-sm font-medium transition-all duration-300 opacity-0 translate-y-4 scale-95">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg" id="toast-icon-wrap">
                    <svg id="toast-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                </div>
                <span id="toast-text">Copied!</span>
            </div>

            {{-- Header Section --}}
            <div class="flex flex-col gap-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <div class="flex items-center justify-center w-10 h-10 rounded-2xl bg-linear-to-br from-zinc-900 to-zinc-700 dark:from-white dark:to-zinc-300 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white dark:text-zinc-900">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">{{ __('Your Vault') }}</h1>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $passwords->count() }} {{ Str::plural('credential', $passwords->count()) }} &middot; AES-256 encrypted
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('passwords.create') }}"
                       class="group inline-flex items-center gap-2.5 h-11 px-6 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-2xl text-sm font-semibold hover:shadow-lg hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-90">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('Add Password') }}
                    </a>
                </div>

                {{-- Search & Filters --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="GET" action="{{ route('passwords.index') }}" class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4.5 h-4.5 text-zinc-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="{{ __('Search passwords, usernames, URLs...') }}"
                               class="w-full h-11 pl-11 pr-4 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-700 transition-all" />
                        @if(request('search'))
                            <a href="{{ route('passwords.index') }}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </a>
                        @endif
                    </form>

                    {{-- View toggle --}}
                    <div class="flex items-center bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-1">
                        <button @click="viewMode = 'grid'" :class="viewMode === 'grid' ? 'bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300'" class="flex items-center justify-center w-9 h-9 rounded-xl transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" /></svg>
                        </button>
                        <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300'" class="flex items-center justify-center w-9 h-9 rounded-xl transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                        </button>
                    </div>
                </div>

                @if(request('search'))
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ $passwords->count() }} {{ Str::plural('result', $passwords->count()) }} for "<span class="font-medium text-zinc-700 dark:text-zinc-300">{{ request('search') }}</span>"
                    </p>
                @endif
            </div>

            {{-- Password Cards --}}
            @forelse($passwords as $pw)
                @if($loop->first)
                <div :class="viewMode === 'grid' ? 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4' : 'flex flex-col gap-3'">
                @endif

                <div x-data="{ show: false, editing: false, deleting: false, revealedPassword: '', isFav: {{ $pw->favorite ? 'true' : 'false' }}, copyState: 'idle' }"
                     class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 hover:shadow-lg hover:shadow-zinc-200/50 dark:hover:shadow-zinc-900/50 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300 flex"
                     :class="viewMode === 'list' ? 'flex-row items-center p-4 gap-4' : 'flex-col'"
                     style="animation: fadeInUp 0.4s ease-out {{ $loop->index * 0.05 }}s both">

                    {{-- Card Header --}}
                    <div :class="viewMode === 'list' ? 'flex items-center gap-3.5 flex-1 min-w-0' : 'p-5 pb-0'">
                        <div :class="viewMode === 'list' ? 'flex items-center gap-3.5 flex-1 min-w-0' : ''">
                            <div class="flex items-start gap-3.5" :class="viewMode === 'list' ? '' : ''">
                                {{-- Avatar with gradient --}}
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
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-semibold text-zinc-900 dark:text-white truncate">{{ $pw->title }}</p>
                                        {{-- Favorite star --}}
                                        <button @click.stop="fetch('{{ route('passwords.favorite', $pw) }}', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Accept': 'application/json' } }).then(r => r.json()).then(d => isFav = d.favorite)"
                                                class="shrink-0 p-0.5 transition-all duration-200" :class="isFav ? 'text-amber-400 scale-110' : 'text-zinc-300 dark:text-zinc-600 opacity-0 group-hover:opacity-100 hover:text-amber-400'">
                                            <svg xmlns="http://www.w3.org/2000/svg" :fill="isFav ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate mt-0.5">{{ $pw->username }}</p>
                                    @if($pw->url)
                                        <a href="{{ $pw->url }}" target="_blank" rel="noopener noreferrer" class="text-xs text-blue-500/70 dark:text-blue-400/60 hover:text-blue-600 dark:hover:text-blue-400 truncate mt-0.5 inline-flex items-center gap-1 transition-colors">
                                            {{ Str::limit($pw->url, 35) }}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-2.5 h-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Password Field (hidden in list compact mode) --}}
                    <div :class="viewMode === 'list' ? 'hidden sm:block w-52 shrink-0' : 'px-5 mt-4'">
                        <div class="flex items-center gap-2 p-3 bg-zinc-50/80 dark:bg-zinc-800/40 rounded-xl border border-zinc-100 dark:border-zinc-800/50">
                            <div class="flex-1 min-w-0">
                                <p x-show="!show" class="text-sm font-mono text-zinc-400 dark:text-zinc-500 tracking-wider">••••••••••••</p>
                                <p x-show="show" x-cloak class="text-sm font-mono text-zinc-700 dark:text-zinc-300 truncate break-all" x-text="revealedPassword"></p>
                            </div>
                            <button @click="if (!show) { fetch('{{ route('passwords.reveal', $pw) }}', { headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(r => r.json()).then(d => { revealedPassword = d.password; show = true; }); } else { show = false; revealedPassword = ''; }" class="shrink-0 p-1.5 rounded-lg text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 hover:bg-white dark:hover:bg-zinc-700 transition-all" :title="show ? 'Hide' : 'Reveal'">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Card Actions --}}
                    <div :class="viewMode === 'list' ? 'flex items-center gap-1 shrink-0' : 'flex items-center gap-1.5 p-5 pt-4 mt-auto border-t border-zinc-100 dark:border-zinc-800/60'">
                        {{-- Copy --}}
                        <button @click="copyState = 'loading'; fetch('{{ route('passwords.reveal', $pw) }}', { headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(r => r.json()).then(d => { navigator.clipboard.writeText(d.password); copyState = 'copied'; showActionToast('Password copied!', 'success'); setTimeout(() => copyState = 'idle', 2000); })"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 h-8 rounded-xl text-xs font-medium transition-all duration-200"
                                :class="copyState === 'copied' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white'">
                            <template x-if="copyState === 'idle'">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9.75a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" /></svg>
                                    <span x-show="viewMode === 'grid'">Copy</span>
                                </span>
                            </template>
                            <template x-if="copyState === 'copied'">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                    <span x-show="viewMode === 'grid'">Copied!</span>
                                </span>
                            </template>
                            <template x-if="copyState === 'loading'">
                                <svg class="w-3.5 h-3.5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            </template>
                        </button>

                        {{-- Copy Username --}}
                        <button @click="navigator.clipboard.writeText($el.dataset.username); showActionToast('Username copied!', 'info')"
                                data-username="{{ $pw->username }}"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 h-8 rounded-xl text-xs font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition-all" title="{{ __('Copy username') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                            <span x-show="viewMode === 'grid'">User</span>
                        </button>

                        {{-- Edit --}}
                        <button @click="editing = true"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 h-8 rounded-xl text-xs font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            <span x-show="viewMode === 'grid'">Edit</span>
                        </button>

                        {{-- Delete --}}
                        <button @click="deleting = true"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 h-8 rounded-xl text-xs font-medium text-zinc-600 dark:text-zinc-400 hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                            <span x-show="viewMode === 'grid'">Delete</span>
                        </button>
                    </div>

                    {{-- Edit Modal --}}
                    <template x-teleport="body">
                        <div x-show="editing" x-cloak
                             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                             @keydown.escape.window="editing = false">
                            <div @click.outside="editing = false"
                                 x-show="editing"
                                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                                 class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 shadow-2xl w-full max-w-lg overflow-hidden">

                                {{-- Modal Header --}}
                                <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-100 dark:border-zinc-800">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4.5 h-4.5 text-zinc-600 dark:text-zinc-400"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                        </div>
                                        <h3 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Edit Password') }}</h3>
                                    </div>
                                    <button @click="editing = false" class="p-2 rounded-xl text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('passwords.update', $pw) }}" class="p-6 space-y-5">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Website or App') }}</label>
                                        <input type="text" name="site_name" value="{{ $pw->title }}" required
                                            class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 transition-all" />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Username or Email') }}</label>
                                        <input type="text" name="username" value="{{ $pw->username }}" required
                                            class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 transition-all" />
                                    </div>

                                    <div x-data="{ showPw: false }">
                                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Password') }} <span class="text-zinc-400 font-normal">({{ __('leave blank to keep current') }})</span></label>
                                        <div class="relative">
                                            <input :type="showPw ? 'text' : 'password'" name="password" placeholder="••••••••••••"
                                                class="w-full h-11 px-4 pr-11 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm font-mono text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 transition-all" />
                                            <button type="button" @click="showPw = !showPw" class="absolute inset-y-0 right-0 w-11 flex items-center justify-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors">
                                                <svg x-show="!showPw" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                                <svg x-show="showPw" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('URL') }} <span class="text-zinc-400 font-normal">({{ __('optional') }})</span></label>
                                        <input type="url" name="url" value="{{ $pw->url }}"
                                            class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 transition-all" />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Notes') }} <span class="text-zinc-400 font-normal">({{ __('optional') }})</span></label>
                                        <textarea name="notes" rows="2"
                                            class="w-full px-4 py-3 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 transition-all resize-none">{{ $pw->notes }}</textarea>
                                    </div>

                                    <div class="flex items-center justify-end gap-3 pt-2">
                                        <button type="button" @click="editing = false" class="h-10 px-5 text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300 transition-colors">{{ __('Cancel') }}</button>
                                        <button type="submit" class="h-10 px-6 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-xl text-sm font-semibold hover:shadow-lg active:scale-[0.97] transition-all">{{ __('Save Changes') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </template>

                    {{-- Delete Confirmation Modal --}}
                    <template x-teleport="body">
                        <div x-show="deleting" x-cloak
                             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                             @keydown.escape.window="deleting = false">
                            <div @click.outside="deleting = false"
                                 x-show="deleting"
                                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                                 class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 shadow-2xl w-full max-w-sm overflow-hidden">
                                <div class="p-8 text-center">
                                    <div class="h-14 w-14 rounded-2xl bg-red-50 dark:bg-red-500/10 flex items-center justify-center mx-auto mb-5 ring-8 ring-red-50/50 dark:ring-red-500/5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">{{ __('Delete') }} "{{ $pw->title }}"?</h3>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ __('This action cannot be undone. This credential and all its data will be permanently removed from your vault.') }}</p>
                                </div>
                                <div class="flex items-center gap-3 px-6 pb-6">
                                    <button @click="deleting = false" class="flex-1 h-11 rounded-xl text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all">{{ __('Cancel') }}</button>
                                    <form method="POST" action="{{ route('passwords.destroy', $pw) }}" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full h-11 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-semibold active:scale-[0.97] transition-all shadow-lg shadow-red-500/20">{{ __('Delete Forever') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                @if($loop->last)
                </div>
                @endif
            @empty
                {{-- Empty State --}}
                <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 px-6 py-24 text-center">
                    <div class="relative inline-flex items-center justify-center mb-6">
                        <div class="absolute w-24 h-24 rounded-full bg-zinc-100/80 dark:bg-zinc-800/50 animate-pulse"></div>
                        <div class="relative h-16 w-16 rounded-2xl bg-linear-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-700 flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-zinc-400 dark:text-zinc-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">{{ __('Your vault is empty') }}</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto mb-8">{{ __('Start securing your credentials by adding your first password. Everything is encrypted end-to-end.') }}</p>
                    <a href="{{ route('passwords.create') }}"
                       class="inline-flex items-center gap-2.5 h-11 px-6 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-2xl text-sm font-semibold hover:shadow-lg active:scale-[0.97] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('Add Your First Password') }}
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        function passwordVault() {
            return {
                viewMode: localStorage.getItem('pw-view') || 'grid',
                init() {
                    this.$watch('viewMode', (v) => localStorage.setItem('pw-view', v));
                }
            }
        }

        function showActionToast(message, type = 'success') {
            const toast = document.getElementById('action-toast');
            const text = document.getElementById('toast-text');
            const iconWrap = document.getElementById('toast-icon-wrap');

            text.textContent = message;

            // Reset classes
            toast.className = 'fixed bottom-6 right-6 z-60 flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-2xl text-sm font-medium transition-all duration-300';

            if (type === 'success') {
                toast.classList.add('bg-emerald-600', 'text-white', 'shadow-emerald-500/25');
                iconWrap.className = 'flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg';
            } else if (type === 'info') {
                toast.classList.add('bg-blue-600', 'text-white', 'shadow-blue-500/25');
                iconWrap.className = 'flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg';
            }

            toast.style.display = 'flex';
            requestAnimationFrame(() => {
                toast.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
                toast.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            });
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
                toast.classList.add('opacity-0', 'translate-y-4', 'scale-95');
                setTimeout(() => toast.style.display = 'none', 300);
            }, 2500);
        }
    </script>
</x-layouts::app>
