<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6 text-center">Orders</h2>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-center">User</th>
                    <th class="p-3 text-center">Total</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            @foreach ($orders as $order)
                <tr class="border-b text-center hover:bg-gray-100 transition duration-200">
                    <td class="p-3">{{ $order->user->name }}</td>
                    <td class="p-3">₱{{ $order->total }}</td>
                    <td class="p-3">{{ $order->status }}</td>

                    <td class="p-3">
                        <div class="flex justify-center gap-2 flex-wrap">

                            <a href="{{ route('admin.orders.status', [$order, 'processing']) }}"
                                class="bg-blue-400 px-3 py-1 rounded text-white 
                                       hover:bg-blue-500 hover:scale-105 
                                       transition duration-200">
                                Process
                            </a>

                            <a href="{{ route('admin.orders.status', [$order, 'shipped']) }}"
                                class="bg-yellow-400 px-3 py-1 rounded text-white 
                                       hover:bg-yellow-500 hover:scale-105 
                                       transition duration-200">
                                Ship
                            </a>

                            <a href="{{ route('admin.orders.status', [$order, 'delivered']) }}"
                                class="bg-green-400 px-3 py-1 rounded text-white 
                                       hover:bg-green-500 hover:scale-105 
                                       transition duration-200">
                                Done
                            </a>

                            <a href="{{ route('admin.orders.cancel', $order) }}"
                                class="bg-red-500 text-white px-3 py-1 rounded 
                                       hover:bg-red-600 hover:scale-105 
                                       transition duration-200">
                                Cancel
                            </a>

                        </div>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

</x-layouts.admin-layout>
