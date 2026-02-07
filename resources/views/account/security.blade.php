<x-layouts::app :title="__('Account Security')">
    <div class="min-h-screen bg-white dark:bg-black py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            {{-- Header --}}
            <header class="mb-12 border-b border-gray-100 dark:border-zinc-800 pb-10">
                <div class="flex items-center gap-2 mb-3">
                    <div class="h-2 w-2 rounded-full bg-black dark:bg-white animate-pulse"></div>
                    <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">System.Auth</h2>
                </div>
                <h1 class="text-5xl font-black text-black dark:text-white tracking-tighter uppercase leading-none">
                    Security <span class="text-gray-300 dark:text-zinc-700">Settings</span>
                </h1>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                {{-- Left Sidebar: Instructions --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-gray-50 dark:bg-zinc-900 rounded-3xl border border-gray-100 dark:border-zinc-800">
                        <i class="fas fa-shield-halved text-black dark:text-white text-xl mb-4"></i>
                        <h3 class="text-xs font-black uppercase tracking-widest text-black dark:text-white mb-2">Master Access</h3>
                        <p class="text-[10px] font-bold text-gray-500 uppercase leading-relaxed tracking-wide">
                            Your master password is the primary encryption key for your vault. Changing it will re-encrypt all stored credentials locally.
                        </p>
                    </div>

                    <div class="p-6 border-2 border-dashed border-gray-100 dark:border-zinc-900 rounded-3xl">
                        <h3 class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Protocol Status</h3>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span class="text-[10px] font-black text-black dark:text-white uppercase">SSL_ENCRYPTED</span>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Forms --}}
                <div class="lg:col-span-2 space-y-12">
                    
                    {{-- Password Form --}}
                    <section class="bg-white dark:bg-zinc-950 p-8 rounded-[2.5rem] border-2 border-gray-100 dark:border-zinc-900 shadow-2xl shadow-gray-200/50 dark:shadow-none">
                        <h2 class="text-sm font-black uppercase tracking-[0.3em] text-black dark:text-white mb-8 flex items-center gap-3">
                            <i class="fas fa-key text-gray-300"></i>
                            Change Master Key
                        </h2>

                        <form method="POST" action="{{ route('account.change-password') }}" class="space-y-6">
                            @csrf
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Current Password</label>
                                <input type="password" name="current_password" required 
                                    class="w-full h-14 px-6 bg-gray-50 dark:bg-zinc-900 border-none rounded-2xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-bold text-sm text-black dark:text-white" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">New Key</label>
                                    <input type="password" name="new_password" required 
                                        class="w-full h-14 px-6 bg-gray-50 dark:bg-zinc-900 border-none rounded-2xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-bold text-sm text-black dark:text-white" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Confirm Key</label>
                                    <input type="password" name="new_password_confirmation" required 
                                        class="w-full h-14 px-6 bg-gray-50 dark:bg-zinc-900 border-none rounded-2xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-bold text-sm text-black dark:text-white" />
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="h-14 px-10 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl hover:scale-[1.02] active:scale-95 transition-all">
                                    Update Protocol
                                </button>
                            </div>
                        </form>
                    </section>

                    {{-- 2FA Form --}}
                    <section class="p-8 rounded-[2.5rem] border-2 border-gray-100 dark:border-zinc-900">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="max-w-md">
                                <h2 class="text-sm font-black uppercase tracking-[0.3em] text-black dark:text-white mb-2 flex items-center gap-3">
                                    <i class="fas fa-fingerprint text-gray-300"></i>
                                    Two-Factor (2FA)
                                </h2>
                                <p class="text-[10px] font-bold text-gray-400 uppercase leading-relaxed tracking-wider">
                                    Add an extra layer of defense. Authentication codes will be required for every session initialization.
                                </p>
                            </div>

                            @php $user = Auth::user(); @endphp
                            @if($user && $user->two_factor_secret)
                                <form method="POST" action="{{ route('account.2fa.disable') }}">
                                    @csrf
                                    <button type="submit" class="px-8 py-4 border-2 border-red-500 text-red-500 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                        Disable 2FA
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('account.2fa.enable') }}">
                                    @csrf
                                    <button type="submit" class="px-8 py-4 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-xl">
                                        Enable 2FA
                                    </button>
                                </form>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>