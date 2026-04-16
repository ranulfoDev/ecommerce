<x-layouts.auth-layout>

    <div class="animate-fadeSlide">

        <h2 class="text-2xl font-bold text-center mb-6 text-white">Create Account</h2>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-5" id="registerForm">
            @csrf

            <!-- Name -->
            <div class="relative">
                <input type="text" name="name" id="name" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label for="name"
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Full Name
                </label>
            </div>

            <!-- Email -->
            <div class="relative">
                <input type="email" name="email" id="email" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label for="email"
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Email
                </label>
            </div>

            <!-- Password -->
            <div class="relative">
                <input type="password" name="password" id="password" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label for="password"
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Password
                </label>

                <span onclick="togglePassword('password')" class="absolute right-3 top-3 cursor-pointer">👁️</span>
            </div>

            <!-- Confirm -->
            <div class="relative">
                <input type="password" name="password_confirmation" id="confirmPassword" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label for="confirmPassword"
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Confirm Password
                </label>

                <span onclick="togglePassword('confirmPassword')"
                    class="absolute right-3 top-3 cursor-pointer">👁️</span>
            </div>

            <button class="w-full bg-blue-600 text-white py-2 rounded-lg">Create Account</button>

            <p class="text-sm text-center text-white/80">
                Already have account?
                <a href="{{ route('login') }}" class="underline">Login</a>
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
