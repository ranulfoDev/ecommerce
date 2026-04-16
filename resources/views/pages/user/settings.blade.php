<x-layouts.user-layout>

    <div class="max-w-4xl mx-auto mt-10">

        <h2 class="text-3xl font-bold mb-6 text-gray-800">⚙️ Account Settings</h2>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- PROFILE CARD -->
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">👤 Profile Info</h3>

                <p class="text-sm text-gray-500 mb-2">Name</p>
                <p class="font-medium mb-3">{{ auth()->user()->name }}</p>

                <p class="text-sm text-gray-500 mb-2">Email</p>
                <p class="font-medium mb-4">{{ auth()->user()->email }}</p>

                <form method="POST" action="{{ route('user.updateProfile') }}">
                    @csrf

                    <input type="text" name="name" value="{{ auth()->user()->name }}"
                        class="w-full border rounded-lg px-3 py-2 mb-3">

                    <button class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition">
                        Save Changes
                    </button>
                </form>
            </div>

            <!-- SECURITY CARD -->
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">🔒 Security</h3>

                <p class="text-sm text-gray-500 mb-4">
                    Update your password regularly to keep your account secure.
                </p>
                <form method="POST" action="{{ route('user.changePassword') }}">
                    @csrf

                    <input type="password" name="password" placeholder="New Password"
                        class="w-full border rounded-lg px-3 py-2 mb-2">

                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="w-full border rounded-lg px-3 py-2 mb-3">

                    <button class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-black transition">
                        Change Password
                    </button>
                </form>
            </div>

        </div>

    </div>

</x-layouts.user-layout>
