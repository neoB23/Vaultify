@extends('layouts.app')

@section('title', 'Saved Passwords')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-neutral-900 rounded-2xl shadow-xl border border-neutral-200 dark:border-neutral-800 p-8">
    <h1 class="text-2xl font-bold mb-6 text-indigo-900 dark:text-white">Your Saved Passwords</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Site/App</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Username/Email</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Password</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($passwords as $password)
                <tr class="border-b border-neutral-100 dark:border-neutral-800">
                    <td class="px-4 py-3">{{ $password->title }}</td>
                    <td class="px-4 py-3">{{ $password->username }}</td>
                    <td class="px-4 py-3">
                        <input type="password" value="{{ $password->password }}" class="bg-transparent border-none w-32" readonly />
                        <button class="ml-2 text-blue-600 hover:underline" onclick="this.previousElementSibling.type = this.previousElementSibling.type === 'password' ? 'text' : 'password'">Show</button>
                    </td>
                    <td class="px-4 py-3">
                        <!-- Edit/Delete actions can be implemented later -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500">No passwords saved yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8 flex justify-end">
        <a href="{{ route('passwords.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Add New Password</a>
    </div>
</div>
@endsection
