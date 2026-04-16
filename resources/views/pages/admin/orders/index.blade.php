<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">Orders</h2>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">User</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            @foreach ($orders as $order)
                <tr class="border-b">
                    <td class="p-3">{{ $order->user->name }}</td>
                    <td class="p-3">₱{{ $order->total }}</td>
                    <td class="p-3">{{ $order->status }}</td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.orders.status', [$order, 'processing']) }}"
                            class="bg-blue-400 px-2 rounded">Process</a>
                        <a href="{{ route('admin.orders.status', [$order, 'shipped']) }}"
                            class="bg-yellow-400 px-2 rounded">Ship</a>
                        <a href="{{ route('admin.orders.status', [$order, 'delivered']) }}"
                            class="bg-green-400 px-2 rounded">Done</a>
                        <a href="{{ route('admin.orders.cancel', $order) }}"
                            class="bg-red-500 text-white px-2 rounded">Cancel</a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

</x-layouts.admin-layout>
