<x-layouts.auth-layout>

    <div class="animate-fadeSlide">

        <h2 class="text-2xl font-bold text-center mb-2 text-white">Reset Password</h2>
        <p class="text-center text-blue-200 text-sm mb-6">
            Enter your new password
        </p>

        @if ($errors->any())
            <div class="bg-red-500/20 text-red-200 p-2 rounded text-sm text-center mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5" id="resetForm">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email -->
            <div class="relative">
                <input type="email" name="email" value="{{ old('email', request('email')) }}" required
                    placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Email
                </label>
            </div>

            <!-- Password -->
            <div class="relative">
                <input type="password" name="password" id="newPassword" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    New Password
                </label>

                <span onclick="togglePassword('newPassword')" class="absolute right-3 top-3 cursor-pointer">👁️</span>
            </div>

            <!-- Confirm -->
            <div class="relative">
                <input type="password" name="password_confirmation" id="confirmNewPassword" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Confirm Password
                </label>

                <span onclick="togglePassword('confirmNewPassword')"
                    class="absolute right-3 top-3 cursor-pointer">👁️</span>
            </div>

            <!-- Button -->
            <button id="resetBtn"
                class="w-full bg-blue-600 text-white py-2 rounded-lg flex items-center justify-center gap-2">

                <span id="resetText">Reset Password</span>

                <svg id="resetLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
            </button>

        </form>

    </div>

    <script>
        function togglePassword(id) {
            let input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }

        document.getElementById('resetForm').addEventListener('submit', function() {
            document.getElementById('resetText').classList.add('hidden');
            document.getElementById('resetLoader').classList.remove('hidden');
        });
    </script>

</x-layouts.auth-layout>
