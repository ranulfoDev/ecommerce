<x-layouts.user-layout>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="md:col-span-2">
                <div class="bg-white shadow-xl rounded-2xl p-8 border">

                    <h1 class="text-2xl font-semibold mb-6">Checkout Details</h1>

                    <form id="checkoutForm" action="{{ route('user.placeOrder') }}" method="POST">
                        @csrf

                        <input type="hidden" name="coupon_code" id="coupon_code_hidden">
                        <input type="hidden" name="discount_amount" id="discount_amount">

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

                        <!-- PAYMENT METHOD -->
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Payment Method</label>

                            <div class="flex gap-4">
                                <label class="border p-3 rounded-xl w-full cursor-pointer">
                                    <input type="radio" name="payment_method" value="cod" checked
                                        onchange="togglePaymentMethod('cod')">
                                    Cash on Delivery
                                </label>

                                <label class="border p-3 rounded-xl w-full cursor-pointer">
                                    <input type="radio" name="payment_method" value="paypal"
                                        onchange="togglePaymentMethod('paypal')">
                                    PayPal
                                </label>
                            </div>

                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- COD SECTION -->
                        <div id="cod-section">
                            <button id="submitBtn" type="submit"
                                class="w-full bg-pink-500 text-white py-3 rounded-xl flex justify-center items-center gap-2 hover:bg-pink-600">

                                <span id="btnText">Place Order</span>

                                <svg id="spinner" class="hidden animate-spin h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                    </circle>
                                </svg>
                            </button>
                        </div>

                        <!-- PAYPAL SECTION -->
                        <div id="paypal-section" class="hidden" data-total="{{ $total }}">
                            <div id="paypal-button-container"></div>
                        </div>

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

                    <div class="mb-4">
                        <input type="text" id="coupon_code" placeholder="Enter coupon"
                            class="w-full border px-3 py-2 rounded">

                        <button type="button" onclick="applyCoupon()"
                            class="mt-2 w-full bg-gray-800 text-white py-2 rounded">
                            Apply Coupon
                        </button>

                        <p id="coupon_msg" class="text-sm mt-2"></p>
                    </div>

                    <div class="border-t my-4"></div>

                    <div class="flex justify-between font-semibold text-lg">
                        <span>Total</span>
                        <span id="totalText" class="text-pink-500">₱{{ $total }}</span>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function togglePaymentMethod(method) {
            const codSection = document.getElementById('cod-section');
            const paypalSection = document.getElementById('paypal-section');

            if (method === 'cod') {
                codSection.classList.remove('hidden');
                paypalSection.classList.add('hidden');
            } else {
                codSection.classList.add('hidden');
                paypalSection.classList.remove('hidden');
            }
        }

        const form = document.getElementById("checkoutForm");
        const btn = document.getElementById("submitBtn");
        const spinner = document.getElementById("spinner");
        const text = document.getElementById("btnText");

        if (form) {
            form.addEventListener("submit", function(e) {
                const selected = document.querySelector('input[name="payment_method"]:checked').value;

                // 🚫 prevent submit if PayPal
                if (selected === 'paypal') {
                    e.preventDefault();
                    return;
                }

                if (btn) {
                    btn.disabled = true;
                    spinner.classList.remove("hidden");
                    text.innerText = "Processing...";
                }
            });
        }
    </script>

    <!-- PAYPAL JS -->
    <script src="{{ asset('js/paypal-checkout.js') }}"></script>
    <script>
        function applyCoupon() {
            let code = document.getElementById('coupon_code').value.toUpperCase();

            fetch('/apply-coupon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(res => res.json())
                .then(data => {

                    let msg = document.getElementById('coupon_msg');

                    if (data.error) {
                        msg.innerText = data.error;
                        msg.style.color = 'red';
                    } else {
                        msg.innerText = data.message;
                        msg.style.color = 'green';

                        let discount = originalTotal * (data.discount / 100);
                        discountedTotal = originalTotal - discount;

                        document.getElementById('totalText').innerText = "₱" + discountedTotal;

                        // ✅ SAVE TO FORM
                        document.getElementById('coupon_code_hidden').value = code;
                        document.getElementById('discount_amount').value = discount;
                    }
                });
        }
    </script>

</x-layouts.user-layout>
