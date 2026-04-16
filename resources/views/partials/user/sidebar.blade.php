<aside class="w-72 bg-white border-r border-gray-100 min-h-screen px-6 py-6 hidden md:block">

    <h2 class="text-xl font-bold mb-6 text-gray-800">User Panel</h2>

    <ul class="space-y-2 text-sm">

        <!-- DASHBOARD -->
        <li>
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl 
                {{ request()->routeIs('user.dashboard') ? 'bg-gray-900 text-white shadow' : 'hover:bg-gray-100' }}">
                🏠 <span>Dashboard</span>
            </a>
        </li>

        <!-- PRODUCT DETAILS -->
        <li>

            <a href="{{ route('user.products.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl 
               {{ request()->routeIs('user.products.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                🛍️ <span>Products</span>
            </a>
        </li>

        <!-- CART -->
        <li>
            <a href="{{ route('user.cart') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl 
        {{ request()->routeIs('user.cart') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                🛒 <span>Cart System</span>
            </a>
        </li>

        <!-- CHECKOUT -->
        <li>
            <a href="{{ route('user.checkout') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl 
        {{ request()->routeIs('user.checkout') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                💳 <span>Checkout</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.orders') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl 
        {{ request()->routeIs('user.orders.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                💳 <span>My Order</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.analytics') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl 
         {{ request()->routeIs('user.analytics') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100' }}">
                📊 <span>Analytics</span>
            </a>
        </li>
    </ul>

</aside>
