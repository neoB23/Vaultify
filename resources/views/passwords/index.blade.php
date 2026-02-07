<x-layouts::app :title="__('Digital Vault')">
    <div class="min-h-screen bg-white dark:bg-black py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Secure Storage</h2>
                    <h1 class="text-5xl font-black text-black dark:text-white tracking-tighter uppercase leading-none">
                        Digital <span class="text-gray-300 dark:text-zinc-800">Vault</span>
                    </h1>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-4 flex items-center gap-2">
                        <span class="w-8 h-[1px] bg-gray-200 dark:bg-zinc-800"></span>
                        {{ $passwords->count() }} Encrypted Objects
                    </p>
                </div>
                
                <a href="{{ route('passwords.create') }}" 
                   class="h-16 px-10 bg-black dark:bg-white text-white dark:text-black rounded-2xl shadow-2xl hover:scale-[1.02] active:scale-95 transition-all font-black text-[10px] uppercase tracking-[0.2em] flex items-center gap-3">
                    <i class="fas fa-plus text-xs"></i>
                    Add New Entry
                </a>
            </div>

            {{-- Vault List Table --}}
            <div class="bg-white dark:bg-zinc-950 rounded-[2.5rem] border-2 border-gray-100 dark:border-zinc-900 overflow-hidden shadow-2xl shadow-gray-200/50 dark:shadow-none">
                <div class="overflow-x-auto">
                    <table class="min-w-full border-separate border-spacing-0">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-zinc-900/50">
                                <th class="px-8 py-6 text-left text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] border-b border-gray-100 dark:border-zinc-900">Resource</th>
                                <th class="px-8 py-6 text-left text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] border-b border-gray-100 dark:border-zinc-900">Identity</th>
                                <th class="px-8 py-6 text-left text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] border-b border-gray-100 dark:border-zinc-900">Key_Secret</th>
                                <th class="px-8 py-6 text-right text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] border-b border-gray-100 dark:border-zinc-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-900">
                            @forelse($passwords as $password)
                            <tr class="group hover:bg-gray-50/80 dark:hover:bg-zinc-900/30 transition-all">
                                {{-- Site/App Name --}}
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl bg-white dark:bg-zinc-900 border-2 border-gray-100 dark:border-zinc-800 flex items-center justify-center text-black dark:text-white group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black transition-all font-black text-sm">
                                            {{ strtoupper(substr($password->title, 0, 1)) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-black text-black dark:text-white text-sm tracking-tight uppercase">{{ $password->title }}</span>
                                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">Vault_Object</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Username --}}
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-xs font-bold text-gray-600 dark:text-zinc-400 font-mono">
                                        {{ $password->username }}
                                    </div>
                                </td>

                                {{-- Password Interaction --}}
                                <td class="px-8 py-6" x-data="{ show: false }">
                                    <div class="flex items-center gap-3">
                                        <input :type="show ? 'text' : 'password'" 
                                               value="{{ $password->password }}" 
                                               class="bg-transparent border-none p-0 font-mono font-bold text-sm text-black dark:text-white focus:ring-0 w-24 lg:w-32" 
                                               readonly />
                                        
                                        <div class="flex items-center border-l border-gray-200 dark:border-zinc-800 ml-2 pl-3 gap-3">
                                            <button @click="show = !show" class="text-gray-300 hover:text-black dark:hover:text-white transition-colors">
                                                <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                            </button>
                                            <button onclick="navigator.clipboard.writeText('{{ $password->password }}')" class="text-gray-300 hover:text-black dark:hover:text-white transition-colors">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>

                                {{-- Management --}}
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="#" class="h-9 w-9 flex items-center justify-center rounded-lg border border-gray-200 dark:border-zinc-800 text-gray-400 hover:text-black dark:hover:text-white hover:border-black dark:hover:border-white transition-all">
                                            <i class="fas fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button class="h-9 w-9 flex items-center justify-center rounded-lg border border-gray-200 dark:border-zinc-800 text-gray-400 hover:text-red-600 hover:border-red-600 transition-all">
                                            <i class="fas fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-32 text-center">
                                    <div class="flex flex-col items-center max-w-xs mx-auto">
                                        <div class="w-16 h-16 rounded-full border-2 border-dashed border-gray-200 dark:border-zinc-800 flex items-center justify-center mb-6">
                                            <i class="fas fa-box-open text-gray-200 dark:text-zinc-800 text-2xl"></i>
                                        </div>
                                        <h3 class="text-xs font-black text-black dark:text-white uppercase tracking-[0.3em]">Vault Depleted</h3>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-8">No credentials detected in current sector.</p>
                                        <a href="{{ route('passwords.create') }}" class="px-8 py-3 bg-black dark:bg-white text-white dark:text-black rounded-xl font-black text-[9px] uppercase tracking-[0.2em]">
                                            Initialize Entry
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>