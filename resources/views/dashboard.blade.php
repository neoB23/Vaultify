<x-layouts::app :title="__('Command Center')">
    <div class="min-h-screen bg-white dark:bg-black py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            {{-- Header Section --}}
            <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 border-b border-gray-100 dark:border-zinc-800 pb-10">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="h-2 w-2 rounded-full bg-black dark:bg-white animate-pulse"></div>
                        <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">System.Active</h2>
                    </div>
                    <h1 class="text-5xl font-black text-black dark:text-white tracking-tighter uppercase leading-none">
                        Control <span class="text-gray-300 dark:text-zinc-700">Panel</span>
                    </h1>
                </div>
                
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Authorization</span>
                    <div class="flex items-center gap-3 px-4 py-2 bg-gray-50 dark:bg-zinc-900 rounded-full border border-gray-200 dark:border-zinc-800">
                        <i class="fas fa-user-shield text-xs text-black dark:text-white"></i>
                        <span class="text-xs font-bold text-black dark:text-white">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            {{-- Tactical Action Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
                
                {{-- Add Password --}}
                <a href="{{ route('passwords.create') }}" class="group relative overflow-hidden bg-black dark:bg-white p-8 rounded-3xl transition-all hover:scale-[1.02] active:scale-95 shadow-2xl">
                    <div class="relative z-10 flex flex-col justify-between h-32">
                        <i class="fas fa-plus text-white dark:text-black text-2xl transition-transform group-hover:rotate-90"></i>
                        <div>
                            <h3 class="text-lg font-black text-white dark:text-black uppercase tracking-tight">New Entry</h3>
                            <p class="text-gray-400 dark:text-zinc-500 text-[9px] font-bold uppercase tracking-[0.2em]">Add to vault</p>
                        </div>
                    </div>
                    <i class="fas fa-plus absolute -bottom-6 -right-6 text-white/10 dark:text-black/5 text-9xl"></i>
                </a>

                {{-- View Vault --}}
                <a href="{{ route('passwords.index') }}" class="group bg-white dark:bg-zinc-900 p-8 rounded-3xl border-2 border-gray-100 dark:border-zinc-800 transition-all hover:border-black dark:hover:border-white">
                    <div class="flex flex-col justify-between h-32">
                        <div class="h-10 w-10 rounded-xl bg-gray-100 dark:bg-zinc-800 flex items-center justify-center text-black dark:text-white group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black transition-all">
                            <i class="fas fa-list-ul"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-black dark:text-white uppercase tracking-tight">Browse Vault</h3>
                            <p class="text-gray-400 dark:text-zinc-500 text-[9px] font-bold uppercase tracking-[0.2em]">Stored secrets</p>
                        </div>
                    </div>
                </a>

                {{-- Security Settings --}}
                <a href="{{ route('account.security') }}" class="group bg-white dark:bg-zinc-900 p-8 rounded-3xl border-2 border-gray-100 dark:border-zinc-800 transition-all hover:border-black dark:hover:border-white">
                    <div class="flex flex-col justify-between h-32">
                        <div class="h-10 w-10 rounded-xl bg-gray-100 dark:bg-zinc-800 flex items-center justify-center text-black dark:text-white group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black transition-all">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-black dark:text-white uppercase tracking-tight">Security</h3>
                            <p class="text-gray-400 dark:text-zinc-500 text-[9px] font-bold uppercase tracking-[0.2em]">Manage Access</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Bottom Layout: Data & Logs --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Security Checklist --}}
                <div class="bg-gray-50 dark:bg-zinc-900/50 rounded-[2.5rem] border border-gray-200 dark:border-zinc-800 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-[10px] font-black text-black dark:text-white uppercase tracking-[0.3em]">Health Check</h3>
                        <span class="px-2 py-1 bg-black dark:bg-white text-white dark:text-black text-[8px] font-black uppercase rounded">Live</span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 rounded-2xl border border-gray-100 dark:border-zinc-800">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-check-circle text-gray-300 dark:text-zinc-700"></i>
                                <span class="text-xs font-bold uppercase tracking-tight text-gray-600 dark:text-zinc-400">Master Key Integrity</span>
                            </div>
                            <span class="text-[9px] font-black text-black dark:text-white">VERIFIED</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 rounded-2xl border border-gray-100 dark:border-zinc-800">
                            <div class="flex items-center gap-4">
                                <i class="fas fa-shield-halved text-gray-300 dark:text-zinc-700"></i>
                                <span class="text-xs font-bold uppercase tracking-tight text-gray-600 dark:text-zinc-400">Database Encryption</span>
                            </div>
                            <span class="text-[9px] font-black text-black dark:text-white uppercase">AES_256</span>
                        </div>
                    </div>
                </div>

                {{-- Status Card (Variable Safe) --}}
                <div class="bg-white dark:bg-black rounded-[2.5rem] border-4 border-gray-100 dark:border-zinc-900 p-8 flex flex-col justify-center items-center text-center">
                    <div class="mb-4 text-4xl font-black text-black dark:text-white tracking-tighter uppercase italic">
                        Secured
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-6">End-to-End Encryption Active</p>
                    <div class="w-full h-1 bg-gray-100 dark:bg-zinc-900 rounded-full overflow-hidden">
                        <div class="h-full bg-black dark:bg-white w-full"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts::app>