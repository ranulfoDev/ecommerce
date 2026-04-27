<x-layouts.user-layout>

    <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

    <div class="bg-white p-6 rounded shadow">

        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total:</strong> ₱{{ $order->total }}</p>

        <hr class="my-4">

        <h2 class="text-lg font-semibold mb-2">Items</h2>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->items as $item)
                    <tr class="text-center border-t">
                        <td>{{ $item->product_name ?? 'Product' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₱{{ $item->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('user.orders') }}" class="bg-gray-500 text-white px-3 py-1 rounded">
                Back
            </a>
        </div>

    </div>

</x-layouts.user-layout>
