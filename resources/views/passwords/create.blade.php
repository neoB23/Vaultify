<x-layouts::app :title="__('Add New Password')">
    <div class="max-w-lg mx-auto mt-10 bg-white dark:bg-neutral-900 rounded-2xl shadow-xl border border-neutral-200 dark:border-neutral-800 p-8">
        <h1 class="text-2xl font-bold mb-6 text-indigo-900 dark:text-white">Add New Password</h1>
        <form method="POST" action="{{ route('passwords.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Site/App Name</label>
                <input type="text" name="site_name" id="site_name" required class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" placeholder="e.g. Gmail" />
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Username/Email</label>
                <input type="text" name="username" id="username" required class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" placeholder="e.g. user@email.com" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Password</label>
                <input type="password" name="password" id="password" required class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" placeholder="Enter password" />
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Notes (optional)</label>
                <textarea name="notes" id="notes" rows="2" class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 focus:ring-2 focus:ring-blue-500 p-3 bg-white dark:bg-neutral-800" placeholder="Any extra info..."></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Save Password</button>
            </div>
        </form>
    </div>
</x-layouts::app>
