<x-layouts.user-layout>
    <x-slot name="title">Dashboard</x-slot>

    <!-- 🔍 SEARCH + SORT -->
    <div class="bg-white/80 backdrop-blur p-5 rounded-2xl shadow-sm mb-6 border">

        <form method="GET" action="{{ route('user.dashboard') }}" class="flex flex-col md:flex-row gap-3 items-center">

            <!-- preserve filters -->
            <input type="hidden" name="category" value="{{ $category }}">
            <input type="hidden" name="min_price" value="{{ $minPrice }}">
            <input type="hidden" name="max_price" value="{{ $maxPrice }}">
            <input type="hidden" name="rating" value="{{ $rating }}">

            <!-- SEARCH -->
            <input type="text" name="search" value="{{ $search }}" placeholder="🔍 Search products..."
                class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">

            <!-- SORT -->
            <select name="sort" class="border rounded-xl px-4 py-2">
                <option value="">Sort By</option>
                <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>💸 Price Low - High</option>
                <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>💰 Price High - Low</option>
                <option value="best_selling" {{ $sort == 'best_selling' ? 'selected' : '' }}>🔥 Best Selling</option>
            </select>

            <button class="bg-pink-500 text-white px-6 py-2 rounded-xl">
                Search
            </button>

        </form>
    </div>

    <!-- 📱 MOBILE FILTER BUTTON -->
    <div class="md:hidden mb-4">
        <button onclick="toggleFilter()" class="w-full bg-black text-white py-2 rounded-xl">
            🎯 Show Filters
        </button>
    </div>

    <div class="flex gap-6">

        <!-- 🎯 FILTERS -->
        <div id="filterPanel" class="w-72 hidden md:block">

            <form method="GET" action="{{ route('user.dashboard') }}"
                class="bg-white p-6 rounded-2xl shadow-sm border space-y-6 sticky top-6">

                <input type="hidden" name="search" value="{{ $search }}">
                <input type="hidden" name="sort" value="{{ $sort }}">

                <h3 class="font-bold text-lg">🎯 Filters</h3>

                <!-- CATEGORY -->
                <div>
                    <label class="text-sm text-gray-500">Category</label>
                    <select name="category" class="w-full border rounded-xl px-3 py-2 mt-1">
                        <option value="">All</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- PRICE -->
                <div>
                    <label class="text-sm text-gray-500">Price Range</label>
                    <div class="flex gap-2 mt-1">
                        <input type="number" name="min_price" value="{{ $minPrice }}" placeholder="Min"
                            class="w-full border rounded-xl px-3 py-2">
                        <input type="number" name="max_price" value="{{ $maxPrice }}" placeholder="Max"
                            class="w-full border rounded-xl px-3 py-2">
                    </div>
                </div>

                <!-- ⭐ RATING -->
                <div>
                    <label class="text-sm text-gray-500">Rating</label>

                    <div class="mt-2 space-y-2">

                        <button type="submit" name="rating" value="5"
                            class="w-full text-left px-3 py-2 rounded-xl border transition duration-200
    hover:scale-105 hover:shadow-md hover:border-yellow-400 hover:bg-yellow-50 hover:text-yellow-500
    {{ $rating == 5 ? 'bg-yellow-100 border-yellow-400' : '' }}">
                            ⭐⭐⭐⭐⭐
                        </button>

                        <button type="submit" name="rating" value="4"
                            class="w-full text-left px-3 py-2 rounded-xl border transition duration-200
    hover:scale-105 hover:shadow-md hover:border-yellow-400 hover:bg-yellow-50 hover:text-yellow-500
    {{ $rating == 4 ? 'bg-yellow-100 border-yellow-400' : '' }}">
                            ⭐⭐⭐⭐ & up
                        </button>
                        <button type="submit" name="rating" value="3"
                            class="w-full text-left px-3 py-2 rounded-xl border transition duration-200
    hover:scale-105 hover:shadow-md hover:border-yellow-400 hover:bg-yellow-50 hover:text-yellow-500
    {{ $rating == 3 ? 'bg-yellow-100 border-yellow-400' : '' }}">
                            ⭐⭐⭐ & up
                        </button>
                        <a href="{{ route('user.dashboard') }}" class="block text-sm text-gray-500 mt-2">
                            ❌ Clear Rating
                        </a>

                    </div>
                </div>

                <!-- APPLY -->
                <button class="w-full bg-gray-900 text-white py-2.5 rounded-xl">
                    Apply Filters
                </button>

            </form>
        </div>

        <!-- 🛍️ PRODUCTS -->
        <div class="flex-1">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($products as $product)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                        <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}"
                            class="w-full h-44 object-cover">

                        <div class="p-4">
                            <h3 class="font-semibold text-sm">{{ $product->name }}</h3>

                            <p class="text-pink-500 font-bold text-lg">
                                ₱{{ number_format($product->price, 2) }}
                            </p>

                            <p class="text-yellow-400 text-sm">
                                ⭐ {{ number_format(optional($product->reviews)->avg('rating') ?? 0, 1) }}
                            </p>

                            <form action="{{ route('user.cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button class="mt-4 w-full bg-black text-white py-2 rounded-xl">
                                    🛒 Add to Cart
                                </button>
                            </form>

                        </div>
                    </div>
                @empty
                    <p>No products found.</p>
                @endforelse

            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>

        </div>
    </div>


    <script>
        function openModal(name, price, image) {
            const modal = document.getElementById('quickModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('modalName').innerText = name;
            document.getElementById('modalPrice').innerText = "₱" + parseFloat(price).toFixed(2);
            document.getElementById('modalImage').src = image;
        }

        function closeModal() {
            const modal = document.getElementById('quickModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    <script>
        document.querySelectorAll('button[name="rating"]').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('form').submit();
            });
        });
    </script>
    <script>
        function toggleFilter() {
            const panel = document.getElementById('filterPanel');

            panel.classList.toggle('hidden');
        }
    </script>

</x-layouts.user-layout>
