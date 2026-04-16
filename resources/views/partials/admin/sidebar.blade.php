<aside class="w-64 bg-gray-900 text-gray-300 min-h-screen p-5 shadow-xl border-r border-gray-800">

    <!-- LOGO / TITLE -->
    <div class="mb-10 border-b border-gray-800 pb-4">
        <h2 class="text-2xl font-bold text-white tracking-wide flex items-center gap-2">
            ⚡ Admin Panel
        </h2>
        <p class="text-xs text-gray-400">Management System</p>
    </div>

    <!-- MENU -->
    <ul class="space-y-1 text-sm">

        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
                        : 'hover:bg-gray-800 hover:text-white' }}">

                <span class="text-lg">📊</span> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.users.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">👥</span> User Management
            </a>
        </li>

        <li>
            <a href="{{ route('admin.products.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.products.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">📦</span> Products
            </a>
        </li>

        <li>
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.categories.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="taext-lg">🗂️</span> Categories
            </a>
        </li>

        <li>
            <a href="{{ route('admin.orders.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.orders.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">🛒</span> Orders
            </a>
        </li>

        <li>
            <a href="{{ route('admin.payments.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.payments.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">💰</span> Payments
            </a>
        </li>

        <li>
            <a href="{{ route('admin.coupons.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.coupons.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">🎟️</span> Coupons
            </a>
        </li>

        <li>
            <a href="{{ route('admin.reviews.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.reviews.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">⭐</span> Reviews
            </a>
        </li>

        <li>
            <a href="{{ route('admin.reports.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 hover:translate-x-1
    {{ request()->routeIs('admin.reports.index')
        ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-md'
        : 'hover:bg-gray-800 hover:text-white' }}">
                <span class="text-lg">📈</span> Reports
            </a>
        </li>

    </ul>

</aside>
