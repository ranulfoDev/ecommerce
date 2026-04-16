<x-layouts.auth-layout>

    <div class="animate-fadeSlide">

        <h2 class="text-2xl font-bold text-center mb-6 text-white">Welcome Back</h2>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf
            @if (session('error'))
                <div class="bg-red-500/20 text-red-200 p-2 rounded text-sm text-center mb-3">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Email -->
            <div class="relative">
                <input type="email" name="email" required placeholder=" "
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
                <input type="password" name="password" id="loginPassword" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Password
                </label>

                <span onclick="togglePassword('loginPassword')" class="absolute right-3 top-3 cursor-pointer">👁️</span>
            </div>

            <!-- 🔥 FORGOT PASSWORD (ADDED) -->
            <div class="flex justify-end text-sm">
                <a href="{{ route('password.request') }}" class="text-blue-200 hover:underline">
                    Forgot password?
                </a>
            </div>

            <!-- Button -->
            <button class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg">
                Login
            </button>

            <!-- Register -->
            <p class="text-sm text-center text-white/80">
                No account?
                <a href="{{ route('register') }}" class="underline">Register</a>
            </p>

        </form>

    </div>

    <script>
        function togglePassword(id) {
            let input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</x-layouts.auth-layout>
