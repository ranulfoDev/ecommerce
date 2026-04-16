<x-layouts.admin-layout>
    <x-slot name="title">Admin Settings</x-slot>

    <div class="max-w-4xl mx-auto mt-10">

        <h2 class="text-3xl font-bold mb-6 text-gray-800">⚙️ Admin Settings</h2>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- PROFILE SETTINGS -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold mb-4">👤 Profile</h3>

                <p class="text-sm text-gray-500">Name</p>
                <p class="font-medium mb-3">{{ auth()->user()->name }}</p>

                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ auth()->user()->email }}</p>
            </div>

            <!-- SYSTEM SETTINGS -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold mb-4">⚙️ System</h3>

                <p class="text-sm text-gray-500 mb-2">System Status</p>
                <p class="text-green-500 font-semibold">Active</p>

                <p class="text-sm text-gray-500 mt-4 mb-2">Version</p>
                <p class="font-medium">v1.0</p>
            </div>

        </div>

    </div>
</x-layouts.admin-layout>
