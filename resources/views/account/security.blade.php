<x-layouts::app :title="__('Account Security')">
    <div class="max-w-lg mx-auto mt-10 bg-white dark:bg-neutral-900 rounded-2xl shadow-xl border border-neutral-200 dark:border-neutral-800 p-8">
        <h1 class="text-2xl font-bold mb-6 text-indigo-900 dark:text-white">Account Security</h1>
        <div class="space-y-8">
            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Change Master Password</h2>
                <form method="POST" action="{{ route('account.change-password') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Current Password</label>
                        <input type="password" name="current_password" id="current_password" required class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" />
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">New Password</label>
                        <input type="password" name="new_password" id="new_password" required class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" />
                    </div>
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" />
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Change Password</button>
                    </div>
                </form>
            </div>
            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Two-Factor Authentication (2FA)</h2>
                <p class="mb-4 text-gray-600 dark:text-gray-300">Enhance your account security by enabling 2FA. You will be asked for a code from your authenticator app when logging in.</p>
                @php $user = Auth::user(); @endphp
                @if($user && $user->two_factor_secret)
                    <form method="POST" action="{{ route('account.2fa.disable') }}">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">Disable 2FA</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('account.2fa.enable') }}">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">Enable 2FA</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-layouts::app>
