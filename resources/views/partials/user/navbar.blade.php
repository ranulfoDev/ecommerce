<nav class="bg-white shadow px-10 py-4 flex justify-between items-center relative z-50">

    <h1 class="font-bold text-xl text-gray-800 tracking-wide">
        🛒 E-Commerce
    </h1>

    <div class="flex items-center gap-6">

        <a href="#" class="text-sm text-gray-600 hover:text-pink-500 transition">Shop</a>
        @php
            $cart = session('cart', []);
            $count = array_sum(array_column($cart, 'quantity'));
        @endphp

        <a href="{{ route('user.cart') }}" class="relative text-sm text-gray-600 hover:text-pink-500 transition">

            Cart 🛒

            @if ($count > 0)
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 rounded-full">
                    {{ $count }}
                </span>
            @endif

        </a>
        <!-- PROFILE -->
        <div class="relative">

            <div class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 px-3 py-2 rounded-lg transition"
                id="profileBtn">
                <img src="https://i.pravatar.cc/40" class="rounded-full w-9 h-9 border">
                <span class="text-sm font-medium text-gray-700">
                    {{ auth()->user()->name }}
                </span>
            </div>

            <!-- DROPDOWN -->
            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-3 w-48 bg-white shadow-xl rounded-xl py-2 border z-50">

                <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                    👤 Profile
                </a>

                <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                    ⚙️ Settings
                </a>

                <hr class="my-2">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-red-50 text-red-500">
                        🚪 Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</nav>
<!-- JS -->
<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('dropdownMenu');

    // toggle dropdown
    if (profileBtn && dropdown) {
        profileBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    // smooth nav click
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            this.classList.add('scale-95');
            setTimeout(() => {
                this.classList.remove('scale-95');
            }, 150);
        });
    });
</script>
