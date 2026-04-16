<x-layouts.admin-layout>

    <div class="p-6 space-y-6 bg-gray-50 min-h-screen">

        <!-- HEADER -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                📊 Dashboard
            </h2>

            <div class="flex items-center gap-3">

                <!-- NOTIF -->
                <div class="relative">
                    <button onclick="toggleNotif()" class="text-xl relative">
                        🔔
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                            {{ count($lowStockProducts) }}
                        </span>
                    </button>
                    <span
                        class="hidden absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-xl p-3 z-50 transition-all duration-300"">
                        {{ count($lowStockProducts) }}
                    </span>
                </div>
                <div id="notifBox" class="hidden absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-xl p-3 z-50">

                    <p class="font-semibold mb-2">Notifications</p>

                    @forelse ($lowStockProducts as $product)
                        <p class="text-red-500 text-sm">
                            Low stock: {{ $product->name }}
                        </p>
                    @empty
                        <p class="text-gray-500 text-sm">No notifications</p>
                    @endforelse

                </div>

                <!-- FILTER -->
                <form method="GET">
                    <select name="filter" onchange="this.form.submit()" class="border rounded-lg px-3 py-1 text-sm">
                        <option value="today">Today</option>
                        <option value="7days">Last 7 Days</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div
                class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all border border-gray-100">
                <p class="text-gray-400 text-sm">Orders</p>
                <h2 class="text-3xl font-bold">{{ $totalOrders }}</h2>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all border border-gray-100">
                <p class="text-gray-400 text-sm">Customers</p>
                <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all border border-gray-100">
                <div
                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transition">
                    <h2 class="text-3xl font-bold text-green-600">
                        ₱{{ number_format($totalSales, 2) }}
                    </h2>
                </div>
            </div>

        </div>

        <!-- ORDER STATUS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-orange-50 border border-orange-200 p-5 rounded-2xl hover:shadow-md transition">
                <p class="text-gray-400 text-sm">Pending Orders</p>
                <h2 class="text-2xl font-bold text-orange-500">{{ $pendingOrders }}</h2>
            </div>

            <div class="bg-green-50 border border-green-200 p-5 rounded-2xl hover:shadow-md transition">
                <p class="text-gray-400 text-sm">Completed Orders</p>
                <h2 class="text-2xl font-bold text-green-500">{{ $completedOrders }}</h2>
            </div>

        </div>

        <!-- TABLES -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- PRODUCTS -->
            <div class="bg-white/70 backdrop-blur-lg p-5 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-semibold mb-4">Latest Products</h3>

                <table class="w-full text-sm border-separate border-spacing-y-2">
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="bg-gray-50 hover:bg-blue-50 transition duration-200">
                                <td class="p-2">{{ $product->name }}</td>
                                <td>₱{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- USERS -->
            <div class="bg-white p-5 rounded-2xl shadow-sm">
                <h3 class="font-semibold mb-4">Recent Users</h3>

                <table class="w-full text-sm border-separate border-spacing-y-2">
                    <tbody>
                        @foreach ($recentUsers as $user)
                            <tr class="bg-gray-50 hover:bg-gray-100">
                                <td class="p-2">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <!-- LOW STOCK + TOP -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-red-50 border border-red-300 p-5 rounded-2xl shadow-sm">
                <h3 class="font-semibold mb-4 text-red-600 flex items-center gap-2">
                    ⚠️ Low Stock
                </h3>

                @forelse ($lowStockProducts as $product)
                    <p class="text-red-600">{{ $product->name }} ({{ $product->stock }})</p>
                @empty
                    <p>No issues</p>
                @endforelse
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm">
                <h3 class="font-semibold mb-4">Top Products</h3>

                @foreach ($topProducts as $index => $product)
                    <div class="flex justify-between items-center py-2 border-b">
                        <span>#{{ $index + 1 }} {{ $product->name }}</span>
                        <span class="font-semibold text-blue-600">
                            {{ $product->total_sold ?? 0 }}
                        </span>
                    </div>
                @endforeach
            </div>

        </div>

    </div>


    <div class="bg-white p-5 rounded-2xl shadow-sm mt-6">
        <h3 class="font-semibold mb-4">Sales Overview</h3>
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        // TOGGLE NOTIFICATION
        function toggleNotif() {
            const box = document.getElementById('notifBox');
            box.classList.toggle('hidden');
        }

        // CLICK OUTSIDE TO CLOSE
        document.addEventListener('click', function(event) {
            const notif = document.getElementById('notifBox');
            const button = event.target.closest('button');

            if (!event.target.closest('#notifBox') && !button) {
                notif.classList.add('hidden');
            }
        });

        // OPTIONAL: AUTO CLOSE AFTER 5s
        function autoCloseNotif() {
            const notif = document.getElementById('notifBox');
            setTimeout(() => {
                notif.classList.add('hidden');
            }, 5000);
        }
    </script>
    <script>
        async function loadNotifications() {
            try {
                const res = await fetch('/admin/notifications');
                const data = await res.json();

                const notifBox = document.getElementById('notifBox');
                const badge = document.querySelector('.bg-red-500');

                notifBox.innerHTML = '<p class="font-semibold mb-2">Notifications</p>';

                if (data.length === 0) {
                    notifBox.innerHTML += '<p class="text-gray-500 text-sm">No notifications</p>';
                } else {
                    data.forEach(item => {
                        notifBox.innerHTML += `
                        <p class="text-red-500 text-sm">
                            Low stock: ${item.name}
                        </p>
                    `;
                    });
                }

                // update badge
                badge.innerText = data.length;

            } catch (error) {
                console.log(error);
            }
        }

        // AUTO REFRESH EVERY 5 SECONDS
        setInterval(loadNotifications, 5000);

        // LOAD ON PAGE START
        loadNotifications();
    </script>
    <script>
        const salesData = @json($monthlySales);

        const labels = salesData.map(item => item.label);
        const totals = salesData.map(item => item.total);

        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: totals,
                    backgroundColor: '#3B82F6',
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: value => '₱' + value
                        }
                    }
                }
            }
        });
    </script>
</x-layouts.admin-layout>
