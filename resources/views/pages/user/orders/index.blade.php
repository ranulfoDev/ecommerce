<x-layouts.user-layout>
    <h1 class="text-2xl font-bold mb-4">My Orders</h1>

    @if (session('success'))
        <div class="bg-green-200 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">ID</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr class="text-center border-t">

                        <td>#{{ $order->id }}</td>

                        <td>
                            <span
                                class="px-2 py-1 text-white rounded
                            @if ($order->status == 'pending') bg-yellow-500
                            @elseif($order->status == 'paid') bg-blue-500
                            @elseif($order->status == 'shipped') bg-purple-500
                            @elseif($order->status == 'delivered') bg-green-500
                            @else bg-red-500 @endif
                        ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>₱{{ $order->total }}</td>

                        <td class="flex gap-2 justify-center">
                            <a href="{{ route('user.orders.show', $order->id) }}"
                                class="bg-blue-500 text-white px-2 py-1 rounded">
                                View
                            </a>

                            @if ($order->status === 'pending')
                                <form method="POST" action="{{ route('user.orders.cancel', $order->id) }}">
                                    @csrf
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.user-layout>
