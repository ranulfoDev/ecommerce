<x-layouts.auth-layout>

    <div class="animate-fadeSlide">

        <h2 class="text-2xl font-bold text-center mb-2 text-white">Forgot Password</h2>
        <p class="text-center text-blue-200 text-sm mb-6">
            Enter your email to receive reset link
        </p>

        @if (session('status'))
            <div class="bg-green-500/20 text-green-200 p-2 rounded text-sm text-center mb-3">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="bg-red-500/20 text-red-200 p-2 rounded text-sm text-center mb-3">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5" id="forgotForm">
            @csrf

            <!-- Email -->
            <div class="relative">
                <input type="email" name="email" required placeholder=" "
                    class="peer w-full px-4 pt-7 pb-2 rounded-lg bg-white/70 focus:ring-2 focus:ring-blue-500 outline-none focus:bg-white">

                <label
                    class="absolute left-3 top-2 text-gray-600 text-sm bg-white px-1 rounded transition-all
peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400
peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-600">
                    Email Address
                </label>
            </div>

            <!-- Button -->
            <button id="forgotBtn"
                class="w-full bg-blue-600 text-white py-2 rounded-lg flex items-center justify-center gap-2">

                <span id="forgotText">Send Reset Link</span>

                <svg id="forgotLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
            </button>

            <p class="text-sm text-center text-white/80">
                Back to
                <a href="{{ route('login') }}" class="underline">Login</a>
            </p>

        </form>

    </div>

    <script>
        document.getElementById('forgotForm').addEventListener('submit', function() {
            document.getElementById('forgotText').classList.add('hidden');
            document.getElementById('forgotLoader').classList.remove('hidden');
        });
    </script>

</x-layouts.auth-layout>
