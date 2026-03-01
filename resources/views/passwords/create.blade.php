<x-layouts::app :title="__('Add Password')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 mb-8 text-sm text-zinc-400 dark:text-zinc-500">
                <a href="{{ route('passwords.index') }}" class="hover:text-zinc-700 dark:hover:text-zinc-300 transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /></svg>
                    {{ __('Vault') }}
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-zinc-700 dark:text-zinc-300 font-medium">{{ __('New') }}</span>
            </nav>

            {{-- Header --}}
            <header class="mb-8">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-10 h-10 rounded-2xl bg-linear-to-br from-zinc-900 to-zinc-700 dark:from-white dark:to-zinc-300 flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white dark:text-zinc-900"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">{{ __('Add a new password') }}</h1>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Store a new credential securely in your vault.') }}</p>
                    </div>
                </div>
            </header>

            {{-- Form Card --}}
            <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 shadow-sm overflow-hidden" x-data="createPasswordForm()">
                <form method="POST" action="{{ route('passwords.store') }}" class="p-6 sm:p-8 space-y-6">
                    @csrf

                    {{-- Site/App Name --}}
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Website or App') }} <span class="text-red-400">*</span></label>
                        <input type="text" name="site_name" id="site_name" required value="{{ old('site_name') }}"
                            class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all"
                            placeholder="{{ __('e.g. Google, GitHub, Netflix') }}" />
                        @error('site_name')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Username/Email --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Username or Email') }} <span class="text-red-400">*</span></label>
                        <input type="text" name="username" id="username" required value="{{ old('username') }}"
                            class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all"
                            placeholder="{{ __('you@example.com') }}" />
                        @error('username')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password with Generator --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Password') }} <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                                x-model="password"
                                class="w-full h-11 px-4 pr-24 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm font-mono text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all"
                                placeholder="••••••••••••" />
                            <div class="absolute inset-y-0 right-0 flex items-center gap-0.5 pr-1.5">
                                {{-- Generate button --}}
                                <button type="button" @click="generatePassword()" class="p-2 rounded-lg text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition-all" title="{{ __('Generate password') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" /></svg>
                                </button>
                                {{-- Toggle visibility --}}
                                <button type="button" @click="showPassword = !showPassword" class="p-2 rounded-lg text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors">
                                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Password Strength Meter --}}
                        <div x-show="password.length > 0" x-cloak class="mt-3 space-y-2">
                            <div class="flex gap-1">
                                <div class="h-1 flex-1 rounded-full transition-all duration-300"
                                     :class="strength >= 1 ? strengthColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                                <div class="h-1 flex-1 rounded-full transition-all duration-300"
                                     :class="strength >= 2 ? strengthColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                                <div class="h-1 flex-1 rounded-full transition-all duration-300"
                                     :class="strength >= 3 ? strengthColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                                <div class="h-1 flex-1 rounded-full transition-all duration-300"
                                     :class="strength >= 4 ? strengthColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                            </div>
                            <p class="text-xs font-medium transition-colors" :class="strengthTextColor" x-text="strengthLabel"></p>
                        </div>

                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- URL --}}
                    <div>
                        <label for="url" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('URL') }} <span class="text-zinc-400 font-normal">({{ __('optional') }})</span></label>
                        <input type="url" name="url" id="url" value="{{ old('url') }}"
                            class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all"
                            placeholder="https://example.com" />
                        @error('url')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Notes') }} <span class="text-zinc-400 font-normal">({{ __('optional') }})</span></label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full px-4 py-3 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all resize-none"
                            placeholder="{{ __('Any additional information...') }}">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Security Badge --}}
                    <div class="flex items-center gap-2.5 p-3.5 bg-emerald-50/50 dark:bg-emerald-500/5 border border-emerald-200/50 dark:border-emerald-500/10 rounded-xl">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                        </div>
                        <p class="text-xs text-emerald-700 dark:text-emerald-400">{{ __('All fields are encrypted with AES-256 before being stored. Only you can access your data.') }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between pt-2 border-t border-zinc-100 dark:border-zinc-800">
                        <a href="{{ route('passwords.index') }}" class="text-sm text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300 transition-colors flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit"
                            class="h-11 px-7 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-xl text-sm font-semibold hover:shadow-lg hover:shadow-zinc-900/20 dark:hover:shadow-white/20 active:scale-[0.97] transition-all">
                            {{ __('Save Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function createPasswordForm() {
            return {
                password: '',
                showPassword: false,
                get strength() {
                    const p = this.password;
                    if (!p) return 0;
                    let s = 0;
                    if (p.length >= 8) s++;
                    if (p.length >= 12) s++;
                    if (/[A-Z]/.test(p) && /[a-z]/.test(p)) s++;
                    if (/[0-9]/.test(p) && /[^A-Za-z0-9]/.test(p)) s++;
                    return Math.min(s, 4);
                },
                get strengthLabel() {
                    return ['', '{{ __("Weak") }}', '{{ __("Fair") }}', '{{ __("Good") }}', '{{ __("Strong") }}'][this.strength] || '';
                },
                get strengthColor() {
                    return ['', 'bg-red-400', 'bg-amber-400', 'bg-blue-400', 'bg-emerald-400'][this.strength] || '';
                },
                get strengthTextColor() {
                    return ['', 'text-red-500', 'text-amber-500', 'text-blue-500', 'text-emerald-500'][this.strength] || '';
                },
                generatePassword() {
                    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
                    const array = new Uint32Array(20);
                    crypto.getRandomValues(array);
                    this.password = Array.from(array, x => chars[x % chars.length]).join('');
                    this.showPassword = true;
                }
            }
        }
    </script>
</x-layouts::app>