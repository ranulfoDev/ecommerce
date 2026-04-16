<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">💳 Payments</h2>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="grid grid-cols-4 bg-gray-100 p-4 text-sm font-semibold text-gray-600">
            <div>Amount</div>
            <div>Method</div>
            <div>Status</div>
            <div class="text-center">Actions</div>
        </div>

        <!-- DATA -->
        @forelse ($payments as $pay)
            <div class="grid grid-cols-4 items-center p-4 border-b hover:bg-gray-50 transition">

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
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                            Verified
                        </span>
                    @elseif ($pay->status == 'refunded')
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">
                            Refunded
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-semibold">
                            Pending
                        </span>
                    @endif
                </div>

                <!-- ACTIONS -->
                <div class="flex justify-center gap-2">

                    <a href="{{ route('admin.payments.verify', $pay) }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-sm shadow">
                        ✔ Verify
                    </a>

                    <a href="{{ route('admin.payments.refund', $pay) }}"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm shadow">
                        ✖ Refund
                    </a>

                </div>

            </div>
        @empty
            <div class="p-6 text-center text-gray-500">
                No payments found.
            </div>
        @endforelse

    </div>

</x-layouts.admin-layout>
