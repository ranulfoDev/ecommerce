<x-layouts.admin-layout>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">💳 Payments</h2>
        <div class="text-sm text-gray-600">
            Total: <span class="font-bold text-lg">₱{{ number_format($payments->sum('amount'), 2) }}</span>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="grid grid-cols-5 bg-gray-100 p-4 text-sm font-semibold text-gray-600">
            <div>Order ID</div>
            <div>Amount</div>
            <div>Method</div>
            <div>Status</div>
            <div class="text-center">Actions</div>
        </div>

        <!-- DATA -->
        @forelse ($payments as $pay)
            <div class="grid grid-cols-5 items-center p-4 border-b hover:bg-gray-50 transition">

                <!-- ORDER ID -->
                <div class="text-gray-700 font-semibold">
                    #{{ $pay->order_id ?? 'N/A' }}
                </div>

                <!-- AMOUNT -->
                <div class="font-bold text-lg text-gray-800">
                    ₱{{ number_format($pay->amount, 2) }}
                </div>

                <!-- METHOD -->
                <div class="text-gray-600 capitalize">
                    {{ $pay->method }}
                </div>

                <!-- STATUS -->
                <div>
                    @if ($pay->status == 'verified')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            ✓ Verified
                        </span>
                    @elseif ($pay->status == 'refunded')
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                            ✖ Refunded
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                            ⏳ Pending
                        </span>
                    @endif
                </div>

                <!-- ACTIONS -->
                <div class="flex justify-center gap-2">
                    @if ($pay->status !== 'verified')
                        <a href="{{ route('admin.payments.verify', $pay) }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-sm shadow transition">
                            ✔ Verify
                        </a>
                    @endif

                    @if ($pay->status !== 'refunded')
                        <a href="{{ route('admin.payments.refund', $pay) }}"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm shadow transition">
                            ✖ Refund
                        </a>
                    @endif
                </div>

            </div>
        @empty
            <div class="p-8 text-center">
                <p class="text-gray-500 text-lg">📭 No payments found.</p>
            </div>
        @endforelse

    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

</x-layouts.admin-layout>
