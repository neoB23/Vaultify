<x-layouts::app :title="__('Security')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            {{-- Header --}}
            <header class="mb-8">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-10 h-10 rounded-2xl bg-linear-to-br from-zinc-900 to-zinc-700 dark:from-white dark:to-zinc-300 flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white dark:text-zinc-900"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">{{ __('Security') }}</h1>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Manage your password and two-factor authentication.') }}</p>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200/80 dark:border-emerald-500/20 rounded-2xl"
                     x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                    <p class="text-sm font-medium text-emerald-700 dark:text-emerald-400">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('status'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200/80 dark:border-emerald-500/20 rounded-2xl">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                    <p class="text-sm font-medium text-emerald-700 dark:text-emerald-400">{{ session('status') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-500/10 border border-red-200/80 dark:border-red-500/20 rounded-2xl">
                    <div class="flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-red-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">{{ __('Please fix the following:') }}</p>
                    </div>
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-500 dark:text-red-400 ml-6">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="space-y-6">

                {{-- Change Password --}}
                <section class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 overflow-hidden">
                    <div class="p-6 sm:p-8 border-b border-zinc-100 dark:border-zinc-800">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4.5 h-4.5 text-zinc-600 dark:text-zinc-400"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /></svg>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Change Password') }}</h2>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">{{ __('Use a strong, unique password to protect your vault.') }}</p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('account.change-password') }}" class="p-6 sm:p-8 space-y-5">
                        @csrf

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Current Password') }}</label>
                            <input type="password" name="current_password" id="current_password" required
                                class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('New Password') }}</label>
                                <input type="password" name="new_password" id="new_password" required
                                    class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all" />
                            </div>
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ __('Confirm Password') }}</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                    class="w-full h-11 px-4 bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-900/10 dark:focus:ring-white/10 focus:border-zinc-300 dark:focus:border-zinc-600 transition-all" />
                            </div>
                        </div>

                        <div class="flex justify-end pt-1">
                            <button type="submit"
                                class="h-10 px-6 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-xl text-sm font-semibold hover:shadow-lg active:scale-[0.97] transition-all">
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </form>
                </section>

                {{-- Two-Factor Authentication --}}
                <section class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200/80 dark:border-zinc-800 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                        <div class="flex items-start gap-3">
                            @php $user = Auth::user(); @endphp
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 {{ $user && $user->two_factor_secret ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500' : 'bg-amber-50 dark:bg-amber-500/10 text-amber-500' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a48.667 48.667 0 0 0-1.488 8.877m5.152-8.627a3 3 0 0 1 5.502 1.5c0 1.627-.31 3.182-.876 4.607M12 10.5a48.578 48.578 0 0 0-1.097 9.014" /></svg>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Two-Factor Authentication') }}</h2>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5 max-w-md">
                                    {{ __('Add an extra layer of security. You\'ll need a verification code each time you sign in.') }}
                                </p>
                                @if($user && $user->two_factor_secret)
                                    <p class="text-xs font-medium text-emerald-600 dark:text-emerald-400 mt-2 flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                        {{ __('Currently enabled') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        @if($user && $user->two_factor_secret)
                            <form method="POST" action="{{ route('account.2fa.disable') }}">
                                @csrf
                                <button type="submit"
                                    class="h-10 px-5 border border-red-200 dark:border-red-500/30 text-red-600 dark:text-red-400 rounded-xl text-sm font-medium hover:bg-red-50 dark:hover:bg-red-500/10 active:scale-[0.97] transition-all">
                                    {{ __('Disable 2FA') }}
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('account.2fa.enable') }}">
                                @csrf
                                <button type="submit"
                                    class="h-10 px-5 bg-linear-to-r from-zinc-900 to-zinc-800 dark:from-white dark:to-zinc-100 text-white dark:text-zinc-900 rounded-xl text-sm font-semibold hover:shadow-lg active:scale-[0.97] transition-all">
                                    {{ __('Enable 2FA') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </section>

                {{-- Security Info --}}
                <div class="bg-zinc-50/80 dark:bg-zinc-800/20 rounded-2xl border border-zinc-200/60 dark:border-zinc-800/40 p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-zinc-500 dark:text-zinc-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                        </div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            {{ __('All your data — passwords, usernames, URLs, and notes — is encrypted with AES-256 before storage. Your master password is hashed and never stored in plain text.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>