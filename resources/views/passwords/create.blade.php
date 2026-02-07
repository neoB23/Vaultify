<x-layouts::app :title="__('Store New Credential')">
    <div class="min-h-screen bg-white dark:bg-black py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-6xl mx-auto">
            {{-- Breadcrumb Navigation --}}
            <nav class="flex items-center gap-2 mb-10 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">
                <a href="{{ route('passwords.index') }}" class="hover:text-black dark:hover:text-white transition-colors">Vault</a>
                <i class="fas fa-chevron-right text-[7px]"></i>
                <span class="text-black dark:text-zinc-500">Encryption Portal</span>
            </nav>

            <div class="flex flex-col lg:flex-row gap-12 items-start">
                
                {{-- Left Side: Context --}}
                <div class="lg:w-1/3 space-y-8">
                    <div>
                        <div class="h-1 w-12 bg-black dark:bg-white mb-6"></div>
                        <h1 class="text-5xl font-black text-black dark:text-white tracking-tighter uppercase leading-[0.9]">
                            Create <br><span class="text-gray-300 dark:text-zinc-800">Secret</span>
                        </h1>
                        <p class="mt-6 text-xs font-bold text-gray-500 dark:text-zinc-500 uppercase tracking-widest leading-relaxed">
                            Input new credentials into the zero-knowledge environment. Data is hashed before transit.
                        </p>
                    </div>

                    {{-- Status Chips --}}
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800">
                            <i class="fas fa-lock text-black dark:text-white text-xs"></i>
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-black dark:text-white">Protocol: AES-256</span>
                        </div>
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gray-50 dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800">
                            <i class="fas fa-terminal text-black dark:text-white text-xs"></i>
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-black dark:text-white">End-to-End Encrypted</span>
                        </div>
                    </div>
                </div>

                {{-- Right Side: The Form Area --}}
                <div class="flex-1 w-full bg-white dark:bg-zinc-950 rounded-[2.5rem] border-2 border-gray-100 dark:border-zinc-900 p-8 lg:p-12 shadow-2xl shadow-gray-200/50 dark:shadow-none">
                    <form method="POST" action="{{ route('passwords.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @csrf
                        
                        {{-- Site/App Name --}}
                        <div class="md:col-span-2 flex flex-col gap-3">
                            <label for="site_name" class="text-[10px] font-black text-gray-400 dark:text-zinc-600 uppercase tracking-[0.3em] ml-1">Identity Provider</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-gray-300 group-focus-within:text-black dark:group-focus-within:text-white transition-colors">
                                    <i class="fas fa-cube text-sm"></i>
                                </div>
                                <input type="text" name="site_name" id="site_name" required 
                                    class="w-full h-16 pl-14 bg-gray-50 dark:bg-zinc-900 border-none rounded-2xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-bold text-sm text-black dark:text-white placeholder-gray-300 dark:placeholder-zinc-700" 
                                    placeholder="DATABASE / SERVICE NAME" />
                            </div>
                        </div>

                        {{-- Username/Email --}}
                        <div class="flex flex-col gap-3">
                            <label for="username" class="text-[10px] font-black text-gray-400 dark:text-zinc-600 uppercase tracking-[0.3em] ml-1">Access Identifier</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-gray-300 group-focus-within:text-black dark:group-focus-within:text-white transition-colors">
                                    <i class="fas fa-at text-sm"></i>
                                </div>
                                <input type="text" name="username" id="username" required 
                                    class="w-full h-16 pl-14 bg-gray-50 dark:bg-zinc-900 border-none rounded-2xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-bold text-sm text-black dark:text-white placeholder-gray-300 dark:placeholder-zinc-700" 
                                    placeholder="USER@ID" />
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="flex flex-col gap-3" x-data="{ show: false }">
                            <label for="password" class="text-[10px] font-black text-gray-400 dark:text-zinc-600 uppercase tracking-[0.3em] ml-1">Secret Key</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-gray-300 group-focus-within:text-black dark:group-focus-within:text-white transition-colors">
                                    <i class="fas fa-key text-sm"></i>
                                </div>
                                <input :type="show ? 'text' : 'password'" name="password" id="password" required 
                                    class="w-full h-16 pl-14 pr-14 bg-gray-50 dark:bg-zinc-900 border-none rounded-2xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-mono font-bold text-sm text-black dark:text-white placeholder-gray-300 dark:placeholder-zinc-700" 
                                    placeholder="••••••••••••" />
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-5 text-gray-300 hover:text-black dark:hover:text-white transition-colors">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="md:col-span-2 flex flex-col gap-3">
                            <label for="notes" class="text-[10px] font-black text-gray-400 dark:text-zinc-600 uppercase tracking-[0.3em] ml-1">Metadata / Comments</label>
                            <textarea name="notes" id="notes" rows="4" 
                                class="w-full p-6 bg-gray-50 dark:bg-zinc-900 border-none rounded-3xl focus:ring-4 focus:ring-black/5 dark:focus:ring-white/5 transition-all font-bold text-sm text-black dark:text-white placeholder-gray-300 dark:placeholder-zinc-700" 
                                placeholder="ANY ADDITIONAL CONTEXTUAL LOGS..."></textarea>
                        </div>

                        {{-- Actions --}}
                        <div class="md:col-span-2 flex items-center justify-between gap-4 mt-6">
                            <a href="{{ route('passwords.index') }}" class="text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] hover:text-red-600 transition-colors">
                                [ ABORT_OPERATION ]
                            </a>
                            <button type="submit" class="h-16 px-12 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-2xl hover:scale-[1.02] active:scale-95 transition-all">
                                Commit to Vault
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>