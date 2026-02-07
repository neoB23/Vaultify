<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-8 items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900 p-8">
        <div class="w-full max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row gap-8 items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-extrabold text-indigo-900 dark:text-white mb-2">Welcome to Your Password Holder</h1>
                    <p class="text-lg text-gray-700 dark:text-gray-200 max-w-xl">
                        Securely store, manage, and access all your passwords in one place. Your passwords are encrypted and only accessible by you.
                    </p>
                </div>
                <img src="/build/assets/vault.svg" alt="Password Vault" class="w-40 h-40 hidden md:block" />
            </div>
            <div class="grid gap-8 md:grid-cols-3">
                <div class="p-8 bg-white dark:bg-neutral-800 rounded-2xl border border-neutral-200 dark:border-neutral-700 shadow-lg flex flex-col items-center">
                    <div class="mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m0 4a8 8 0 100-16 8 8 0 000 16zm0-6a2 2 0 110-4 2 2 0 010 4z"/></svg>
                    </div>
                    <h2 class="text-xl font-semibold mb-2">Add New Password</h2>
                    <p class="mb-4 text-gray-600 dark:text-gray-300 text-center">Easily add new credentials for your favorite sites and apps.</p>
                    <a href="{{ route('passwords.create') }}" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">Add Password</a>
                </div>
                <div class="p-8 bg-white dark:bg-neutral-800 rounded-2xl border border-neutral-200 dark:border-neutral-700 shadow-lg flex flex-col items-center">
                    <div class="mb-4">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h2 class="text-xl font-semibold mb-2">View Saved Passwords</h2>
                    <p class="mb-4 text-gray-600 dark:text-gray-300 text-center">Browse and manage all your saved passwords securely.</p>
                    <a href="{{ route('passwords.index') }}" class="inline-block px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition">View Passwords</a>
                </div>
                <div class="p-8 bg-white dark:bg-neutral-800 rounded-2xl border border-neutral-200 dark:border-neutral-700 shadow-lg flex flex-col items-center">
                    <div class="mb-4">
                        <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4z"/></svg>
                    </div>
                    <h2 class="text-xl font-semibold mb-2">Account Security</h2>
                    <p class="mb-4 text-gray-600 dark:text-gray-300 text-center">Update your profile, change your master password, and manage 2FA.</p>
                    <a href="{{ route('account.security') }}" class="inline-block px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-medium transition">Manage Account</a>
                </div>
            </div>
            <div class="mt-12 p-8 bg-neutral-100 dark:bg-neutral-900 rounded-2xl border border-neutral-200 dark:border-neutral-700 shadow flex flex-col items-center">
                <h3 class="text-2xl font-bold mb-4 text-indigo-900 dark:text-white">Why use Password Holder?</h3>
                <ul class="list-disc pl-6 text-gray-700 dark:text-gray-200 text-lg">
                    <li>All your passwords in one secure vault</li>
                    <li>Strong encryption and privacy</li>
                    <li>Easy access from any device</li>
                    <li>Simple password management tools</li>
                </ul>
            </div>
        </div>
    </div>
</x-layouts::app>
