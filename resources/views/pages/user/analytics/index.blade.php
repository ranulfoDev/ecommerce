<x-layouts.user-layout>

    <div class="max-w-7xl mx-auto p-6 space-y-8">

        <h1 class="text-3xl font-bold">📊 Analytics Dashboard</h1>
        @php
            $conversion = $views > 0 ? round(($orders / $views) * 100, 2) : 0;
        @endphp

        <div class="bg-white p-6 rounded-2xl shadow border">
            <h2 class="font-bold mb-2">⚡ Conversion Rate</h2>

            <div class="overflow-hidden">
                <div class="bg-green-500 h-4 rounded-full" style="width: {{ $conversion }}%">
                </div>
            </div>

            <p class="mt-2 text-sm text-gray-600">
                {{ $conversion }}% of visitors placed orders
            </p>
        </div>


        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Product Views</p>
                <h2 class="text-3xl font-bold mt-2">{{ $views }}</h2>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Add To Cart</p>
                <h2 class="text-3xl font-bold mt-2">{{ $cart }}</h2>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Orders</p>
                <h2 class="text-3xl font-bold mt-2">{{ $orders }}</h2>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Checkout Visits</p>
                <h2 class="text-3xl font-bold mt-2">{{ $checkout }}</h2>
            </div>

        </div>

        <!-- CHART GRID -->
        <div class="grid md:grid-cols-2 gap-6">

            <!-- ORDERS -->
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h2 class="font-bold mb-4">📦 Orders Per Day</h2>
                <canvas id="ordersChart"></canvas>
            </div>

            <!-- SALES -->
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h2 class="font-bold mb-4">💰 Sales</h2>
                <canvas id="salesChart"></canvas>
            </div>

            <!-- TOP PRODUCTS -->
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h2 class="font-bold mb-4">🏆 Top Products</h2>
                <canvas id="productsChart"></canvas>
            </div>

            <!-- MONTHLY REVENUE -->
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h2 class="font-bold mb-4">📈 Monthly Revenue</h2>
                <canvas id="revenueChart"></canvas>
            </div>

        </div>

        <div class="bg-white p-6 rounded-2xl shadow border">

            <h2 class="font-bold mb-4">🔥 Best Selling Products</h2>

            <table class="w-full">

                <thead class="border-b">
                    <tr>
                        <th class="text-left py-2">Product</th>
                        <th class="text-right py-2">Orders</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($topProducts as $product)
                        <tr class="border-b">
                            <td class="py-2">{{ $product->name }}</td>
                            <td class="text-right font-semibold">{{ $product->total }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- TOP SEARCHES -->
        <div class="bg-white p-6 rounded-2xl shadow border">

            <h2 class="font-bold mb-4">🔍 Top Searches</h2>

            <table class="w-full text-left">

                <thead class="border-b">
                    <tr>
                        <th class="py-2">Keyword</th>
                        <th class="py-2 text-right">Search Count</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($searches as $search)
                        <tr class="border-b">
                            <td class="py-2">
                                {{ json_decode($search->meta)->keyword }}
                            </td>
                            <td class="py-2 text-right font-semibold">
                                {{ $search->total }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-gray-500 py-3">
                                No search data yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const barColor = '#4f46e5';


        // ORDERS CHART (BAR)
        new Chart(document.getElementById('ordersChart'), {
            type: 'bar',
            data: {
                labels: @json($ordersChart->pluck('date')),
                datasets: [{
                    label: 'Orders',
                    data: @json($ordersChart->pluck('total')),
                    backgroundColor: barColor
                }]
            }
        });


        // SALES CHART
        new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: {
                labels: @json($salesChart->pluck('date')),
                datasets: [{
                    label: 'Sales',
                    data: @json($salesChart->pluck('total')),
                    backgroundColor: '#16a34a'
                }]
            }
        });


        // TOP PRODUCTS (BAR)
        new Chart(document.getElementById('productsChart'), {
            type: 'bar',
            data: {
                labels: @json($topProducts->pluck('name')),
                datasets: [{
                    label: 'Orders',
                    data: @json($topProducts->pluck('total')),
                    backgroundColor: '#f59e0b'
                }]
            }
        });


        // MONTHLY REVENUE
        new Chart(document.getElementById('revenueChart'), {
            type: 'bar',
            data: {
                labels: @json($monthlyRevenue->pluck('month')),
                datasets: [{
                    label: 'Revenue',
                    data: @json($monthlyRevenue->pluck('total')),
                    backgroundColor: '#ef4444'
                }]
            }
        });


        // AUTO REFRESH
        setInterval(() => {
            location.reload();
        }, 10000);
    </script>

</x-layouts.user-layout>
