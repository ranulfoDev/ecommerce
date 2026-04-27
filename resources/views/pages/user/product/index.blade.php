<x-layouts.user-layout>

    <div class="max-w-7xl mx-auto p-6">

        <!-- TITLE -->
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            🛍️ Products
        </h1>

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-stretch">

            @forelse($products as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col h-full">

                    <!-- IMAGE -->
                    <div class="h-48 w-full overflow-hidden">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- CONTENT -->
                    <div class="p-4 flex flex-col flex-1">

                        <h2 class="font-semibold text-lg text-gray-800 line-clamp-2">
                            {{ $product->name }}
                        </h2>

                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <div class="mt-4">
                            <span class="text-pink-600 font-bold text-lg">
                                ₱{{ $product->formatted_price }}
                            </span>

                            <div>
                                @if ($product->isInStock())
                                    <span class="text-green-500 text-sm">In Stock</span>
                                @else
                                    <span class="text-red-500 text-sm">Out of Stock</span>
                                @endif
                            </div>
                        </div>

                        <!-- BUTTONS SA PINAKA BABA -->
                        <div class="mt-auto flex gap-2 pt-4">

                            <!-- VIEW -->
                            <a href="{{ route('user.products.show', $product->id) }}"
                                class="w-1/2 bg-gray-200 text-gray-700 text-center py-2 rounded-lg hover:bg-gray-300">
                                View
                            </a>

                            <!-- ADD TO CART -->
                            @if ($product->isInStock())
                                <form action="{{ route('user.cart.add') }}" method="POST" class="w-1/2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <button
                                        class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-lg transition">
                                        Add 🛒
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-1/2 bg-gray-300 text-gray-500 py-2 rounded-lg cursor-not-allowed">
                                    Out
                                </button>
                            @endif

                        </div>

                    </div>
                </div>
            @empty

                <p class="col-span-4 text-center text-gray-500">
                    No products available.
                </p>
            @endforelse

        </div>

    </div>

</x-layouts.user-layout>
