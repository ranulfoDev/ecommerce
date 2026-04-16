<x-layouts.landing-layout>

    <!-- HERO -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-24 text-center">
        <h1 class="text-5xl font-bold mb-6">Welcome to MyShop 🛍️</h1>
        <p class="max-w-xl mx-auto text-blue-100 mb-10">
            Discover trending products and amazing deals from our store.
        </p>

        <a href="{{ route('products') }}"
            class="bg-white text-blue-600 px-8 py-3 rounded-xl font-semibold hover:scale-105 transition shadow">
            Browse Products
        </a>
    </section>


    <!-- FEATURED PRODUCTS -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">
                ⭐ Featured Products
            </h2>

            <div class="grid md:grid-cols-4 gap-8">

                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">

                        <div class="h-48 bg-gray-200 rounded-lg mb-4"></div>

                        <h3 class="font-semibold text-lg">Product Name</h3>

                        <p class="text-gray-500 text-sm mb-2">
                            Short product description
                        </p>

                        <p class="text-blue-600 font-bold mb-3">
                            $29.99
                        </p>

                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                            Add to Cart
                        </button>

                    </div>
                @endfor

            </div>

        </div>
    </section>


    <!-- CATEGORIES -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">
                🗂️ Shop by Category
            </h2>

            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-blue-100 p-10 rounded-xl text-center hover:scale-105 transition">
                    👕
                    <h3 class="mt-4 font-semibold">Fashion</h3>
                </div>

                <div class="bg-purple-100 p-10 rounded-xl text-center hover:scale-105 transition">
                    💻
                    <h3 class="mt-4 font-semibold">Electronics</h3>
                </div>

                <div class="bg-green-100 p-10 rounded-xl text-center hover:scale-105 transition">
                    🏠
                    <h3 class="mt-4 font-semibold">Home</h3>
                </div>

                <div class="bg-yellow-100 p-10 rounded-xl text-center hover:scale-105 transition">
                    🎮
                    <h3 class="mt-4 font-semibold">Gaming</h3>
                </div>

            </div>

        </div>
    </section>


    <!-- BEST SELLERS -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">
                🔥 Best Sellers
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                @for ($i = 1; $i <= 3; $i++)
                    <div class="bg-white rounded-xl shadow p-6 flex gap-4 items-center hover:shadow-lg transition">

                        <div class="w-24 h-24 bg-gray-200 rounded-lg"></div>

                        <div>
                            <h3 class="font-semibold">Popular Product</h3>
                            <p class="text-gray-500 text-sm">Best selling item</p>

                            <p class="text-blue-600 font-bold mt-1">
                                $39.99
                            </p>
                        </div>

                    </div>
                @endfor

            </div>

        </div>
    </section>


    <!-- CUSTOMER REVIEWS -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">
                💬 Customer Reviews
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-4">
                        "Amazing store! Fast delivery and great products."
                    </p>
                    <h4 class="font-semibold">⭐⭐⭐⭐⭐</h4>
                    <p class="text-sm text-gray-400">John D.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-4">
                        "Highly recommend this shop!"
                    </p>
                    <h4 class="font-semibold">⭐⭐⭐⭐⭐</h4>
                    <p class="text-sm text-gray-400">Maria S.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-4">
                        "Great quality products!"
                    </p>
                    <h4 class="font-semibold">⭐⭐⭐⭐⭐</h4>
                    <p class="text-sm text-gray-400">David L.</p>
                </div>

            </div>

        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-16">

        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10">

            <div>
                <h3 class="text-white text-xl font-bold mb-4">MyShop</h3>
                <p class="text-gray-400">
                    Your trusted ecommerce store for quality products.
                </p>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Shop</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white">All Products</a></li>
                    <li><a href="#" class="hover:text-white">Best Sellers</a></li>
                    <li><a href="#" class="hover:text-white">Categories</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white">About</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                    <li><a href="#" class="hover:text-white">Support</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Follow Us</h4>
                <div class="flex gap-4 text-xl">
                    🌐 📘 📷 🐦
                </div>
            </div>

        </div>

        <div class="text-center text-gray-500 mt-10">
            © 2026 MyShop. All rights reserved.
        </div>

    </footer>

</x-layouts.landing-layout>
