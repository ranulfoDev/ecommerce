<x-layouts.user-layout>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="md:col-span-2">
                <div class="bg-white shadow-xl rounded-2xl p-8 border">

                    <h1 class="text-2xl font-semibold mb-6">Checkout Details</h1>

                    <form id="checkoutForm" action="{{ route('user.placeOrder') }}" method="POST">
                        @csrf

                        <!-- NAME -->
                        <div class="mb-6">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name"
                                class="w-full px-4 py-3 border rounded-xl
                            {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ADDRESS -->
                        <div class="mb-6">
                            <textarea name="address" rows="3" placeholder="Delivery Address"
                                class="w-full px-4 py-3 border rounded-xl
                            {{ $errors->has('address') ? 'border-red-500' : 'border-gray-200' }}">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PAYMENT -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Payment Method</label>

                            <div class="flex gap-4">
                                <label class="border p-3 rounded-xl w-full cursor-pointer">
                                    <input type="radio" name="payment_method" value="cod" checked>
                                    Cash on Delivery
                                </label>

                                <label class="border p-3 rounded-xl w-full cursor-pointer">
                                    <input type="radio" name="payment_method" value="gcash">
                                    GCash
                                </label>
                            </div>

                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- BUTTON -->
                        <button id="submitBtn"
                            class="w-full bg-pink-500 text-white py-3 rounded-xl flex justify-center items-center gap-2">

                            <span id="btnText">Place Order</span>

                            <svg id="spinner" class="hidden animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                            </svg>
                        </button>

                    </form>

                </div>
            </div>

            <!-- RIGHT SUMMARY -->
            <div>
                <div class="bg-white shadow-xl rounded-2xl p-6 sticky top-10">

                    <h2 class="font-semibold mb-4">Order Summary</h2>

                    <div class="space-y-4">
                        @forelse($cart as $item)
                            <div class="flex items-center gap-3">

                                <img src="{{ asset('storage/' . $item['image']) }}"
                                    class="w-14 h-14 object-cover rounded-lg">

                                <div class="flex-1">
                                    <p class="text-sm font-medium">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">
                                        Qty: {{ $item['quantity'] }}
                                    </p>
                                </div>

                                <span class="text-sm font-semibold">
                                    ₱{{ $item['price'] * $item['quantity'] }}
                                </span>

                            </div>
                        @empty
                            <p class="text-gray-500">Cart is empty</p>
                        @endforelse
                    </div>

                    <div class="border-t my-4"></div>

                    <div class="flex justify-between font-semibold text-lg">
                        <span>Total</span>
                        <span class="text-pink-500">₱{{ $total }}</span>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- SPINNER SCRIPT -->
    <script>
        const form = document.getElementById("checkoutForm");
        const btn = document.getElementById("submitBtn");
        const spinner = document.getElementById("spinner");
        const text = document.getElementById("btnText");

        form.addEventListener("submit", function() {
            btn.disabled = true;
            spinner.classList.remove("hidden");
            text.innerText = "Processing...";
        });
    </script>

</x-layouts.user-layout>
