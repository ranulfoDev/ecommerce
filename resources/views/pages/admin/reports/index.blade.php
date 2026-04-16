<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">📊 Reports & Analytics</h2>

    <!-- ✅ FILTER (DITO) -->
    <form method="GET"
        class="bg-white p-4 rounded-xl shadow mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-4">

        <!-- LEFT SIDE -->
        <div class="flex flex-col md:flex-row gap-4 w-full">

            <!-- FROM -->
            <div class="flex flex-col w-full">
                <label class="text-sm text-gray-500 mb-1">From</label>
                <div class="flex items-center border rounded px-2">
                    <span class="mr-2">📅</span>
                    <input type="date" name="from" value="{{ $from }}" class="w-full p-2 outline-none">
                </div>
            </div>

            <!-- TO -->
            <div class="flex flex-col w-full">
                <label class="text-sm text-gray-500 mb-1">To</label>
                <div class="flex items-center border rounded px-2">
                    <span class="mr-2">📅</span>
                    <input type="date" name="to" value="{{ $to }}" class="w-full p-2 outline-none">
                </div>
            </div>

        </div>

        <!-- RIGHT SIDE BUTTONS -->
        <div class="flex gap-2 justify-end">

            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                🔍 Filter
            </button>

            <a href="{{ route('admin.reports.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg transition">
                ♻ Reset
            </a>

        </div>

    </form>

    <!-- ✅ STATS -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <p>Total Sales</p>
            <h1 class="text-xl font-bold">₱{{ $totalSales }}</h1>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p>Total Orders</p>
            <h1 class="text-xl font-bold">{{ $orders }}</h1>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p>Today Sales</p>
            <h1 class="text-xl font-bold">₱{{ $todaySales }}</h1>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p>Today Orders</p>
            <h1 class="text-xl font-bold">{{ $todayOrders }}</h1>
        </div>
    </div>

    <!-- ✅ CHART -->
    <div class="bg-white p-6 rounded shadow mb-6">
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($monthlySales->toArray())) !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode(array_values($monthlySales->toArray())) !!},
                    borderWidth: 2
                }]
            }
        });
    </script>

    <!-- ✅ TOP PRODUCTS -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-bold mb-4">Top Products</h3>

        @foreach ($topProducts as $product)
            <div class="flex justify-between border-b py-2">
                <span>{{ $product->name }}</span>
                <span>{{ $product->order_items_count }} sold</span>
            </div>
        @endforeach
    </div>

</x-layouts.admin-layout>
