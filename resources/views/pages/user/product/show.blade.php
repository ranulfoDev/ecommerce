<x-layouts.user-layout>

    <div class="max-w-6xl mx-auto p-6">

        <div class="grid md:grid-cols-2 gap-10 bg-white shadow-xl rounded-xl p-6">

            <!-- IMAGE -->
            <div>
                <img src="{{ $product->image }}" class="w-full h-[400px] object-cover rounded-lg shadow">

                <h2 class="text-3xl text-pink-600 font-bold mb-2">
                    ₱{{ $product->formatted_price }}
                </h2>

                @if ($product->isInStock())
                    <span class="text-green-500 font-bold">In Stock</span>
                @else
                    <span class="text-red-500 font-bold">Out of Stock</span>
                @endif
            </div>

            <!-- DETAILS -->
            <div class="flex flex-col justify-between">

                <div>
                    <h1 class="text-3xl font-bold mb-4 text-gray-800">
                        {{ $product->name }}
                    </h1>

                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ $product->description }}
                    </p>

                    <h2 class="text-3xl text-pink-600 font-bold mb-6">
                        ₱{{ number_format($product->price, 2) }}
                    </h2>
                </div>

                <form action="{{ route('user.cart.add') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg text-lg transition shadow">
                        🛒 Add to Cart
                    </button>
                </form>

            </div>

        </div>

        <!-- ⭐ REVIEW FORM (NAKA INSERT NA) -->
        <div class="mt-10 bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Leave a Review</h2>

            <form action="{{ route('user.review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" required
                        class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Comment</label>
                    <textarea name="comment" rows="3" class="w-full border rounded p-2"></textarea>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Submit Review
                </button>
            </form>
        </div>

    </div>

</x-layouts.user-layout>
