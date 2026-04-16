<x-layouts.user-layout>

    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            🛒 Your Cart
        </h1>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">

            <!-- HEADER -->
            <div class="grid grid-cols-4 bg-gray-100 p-4 font-semibold text-gray-600">
                <div>Product</div>
                <div>Price</div>
                <div>Qty</div>
                <div>Action</div>
            </div>

            @php $total = 0; @endphp

            @forelse ($cart as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp

                <div class="grid grid-cols-4 items-center p-4 border-b hover:bg-gray-50 transition">

                    <!-- PRODUCT -->
                    <div class="flex items-center gap-3">
                        <img src="{{ $item['image'] }}" class="w-14 h-14 rounded object-cover">
                        <span class="font-medium">{{ $item['name'] }}</span>
                    </div>

                    <!-- PRICE -->
                    <div class="text-gray-700 font-semibold">
                        ₱{{ number_format($item['price'], 2) }}
                    </div>

                    <!-- QTY UPDATE -->
                    <div>
                        <form action="{{ route('user.cart.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">

                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                class="w-16 border rounded px-2 py-1 text-center" onchange="this.form.submit()">
                        </form>
                    </div>

                    <!-- REMOVE -->
                    <div>
                        <form action="{{ route('user.cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">

                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                Remove
                            </button>
                        </form>
                    </div>

                </div>

            @empty
                <div class="p-6 text-center text-gray-500">
                    Your cart is empty 🥲
                </div>
            @endforelse

        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center mt-6">

            <h2 class="text-xl font-bold text-gray-700">
                Total: ₱{{ number_format($total, 2) }}
            </h2>

            <a href="{{ route('user.checkout') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow transition">
                Proceed to Checkout
            </a>

        </div>

    </div>

</x-layouts.user-layout>
