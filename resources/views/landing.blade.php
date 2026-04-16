<x-layouts.landing-layout>

    <!-- HERO -->
    <section
        class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 text-white py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,white,transparent)]"></div>

        <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

            <div>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                    Elevate Your <br>
                    <span class="text-blue-400">Shopping Experience</span>
                </h1>

                <p class="text-blue-100 text-lg mb-10 max-w-lg">
                    Discover premium products, curated collections, and lightning-fast delivery — all in one place.
                </p>

                <div class="flex gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-blue-500 hover:bg-blue-600 transition px-8 py-3 rounded-xl font-semibold shadow-lg">
                        Get Started
                    </a>

                    <a href="{{ route('login') }}"
                        class="border border-white/40 px-8 py-3 rounded-xl hover:bg-white hover:text-blue-700 transition">
                        Login
                    </a>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-10 shadow-2xl">
                    <div
                        class="h-64 bg-gradient-to-br from-white/20 to-white/5 rounded-xl flex items-center justify-center">
                        <span class="text-xl">🛍️ Featured Products</span>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- TRUST SECTION -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">

            <p class="text-gray-500 mb-8 uppercase tracking-widest text-sm">
                Trusted by global brands
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-lg font-semibold text-gray-400">
                <div class="hover:text-gray-700 transition">BrandOne</div>
                <div class="hover:text-gray-700 transition">BrandTwo</div>
                <div class="hover:text-gray-700 transition">BrandThree</div>
                <div class="hover:text-gray-700 transition">BrandFour</div>
            </div>

        </div>
    </section>


    <!-- CATEGORIES -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-16">
                Explore Categories
            </h2>

            <div class="grid md:grid-cols-4 gap-8">

                <div
                    class="group bg-white p-8 rounded-2xl shadow hover:shadow-2xl transition text-center hover:-translate-y-2">
                    <div class="text-4xl">📱</div>
                    <h3 class="font-semibold mt-4 group-hover:text-blue-600">Electronics</h3>
                </div>

                <div
                    class="group bg-white p-8 rounded-2xl shadow hover:shadow-2xl transition text-center hover:-translate-y-2">
                    <div class="text-4xl">👕</div>
                    <h3 class="font-semibold mt-4 group-hover:text-blue-600">Fashion</h3>
                </div>

                <div
                    class="group bg-white p-8 rounded-2xl shadow hover:shadow-2xl transition text-center hover:-translate-y-2">
                    <div class="text-4xl">🏠</div>
                    <h3 class="font-semibold mt-4 group-hover:text-blue-600">Home</h3>
                </div>

                <div
                    class="group bg-white p-8 rounded-2xl shadow hover:shadow-2xl transition text-center hover:-translate-y-2">
                    <div class="text-4xl">🎮</div>
                    <h3 class="font-semibold mt-4 group-hover:text-blue-600">Gaming</h3>
                </div>

            </div>

        </div>
    </section>


    <!-- PRODUCTS -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-16">
                Featured Products
            </h2>

            <div class="grid md:grid-cols-4 gap-10">

                <div class="group bg-white p-6 rounded-2xl border hover:shadow-xl transition">
                    <img src="{{ asset('storage/products/png.jpg') }}"
                        class="h-40 w-full object-cover rounded-lg mb-4" />
                    <h3 class="font-semibold group-hover:text-blue-600">Smart Watch</h3>
                    <p class="text-gray-500 text-sm">$99</p>
                </div>

                <div class="group bg-white p-6 rounded-2xl border hover:shadow-xl transition">
                    <img src="{{ asset('storage/products/headponds.jpg') }}"
                        class="h-40 w-full object-cover rounded-lg mb-4" />
                    <h3 class="font-semibold group-hover:text-blue-600">Wireless Headphones</h3>
                    <p class="text-gray-500 text-sm">$149</p>
                </div>

                <div class="group bg-white p-6 rounded-2xl border hover:shadow-xl transition">
                    <img src="{{ asset('storage/products/mouse.png') }}"
                        class="h-40 w-full object-cover rounded-lg mb-4" />
                    <h3 class="font-semibold group-hover:text-blue-600">Gaming Mouse</h3>
                    <p class="text-gray-500 text-sm">$59</p>
                </div>

                <div class="group bg-white p-6 rounded-2xl border hover:shadow-xl transition">
                    <img src="{{ asset('storage/products/keyboard.png') }}"
                        class="h-40 w-full object-cover rounded-lg mb-4" />
                    <h3 class="font-semibold group-hover:text-blue-600">Mechanical Keyboard</h3>
                    <p class="text-gray-500 text-sm">$120</p>
                </div>
            </div>

        </div>
    </section>


    <!-- BENEFITS -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-12 text-center">

            <div class="p-6 rounded-xl hover:bg-white hover:shadow transition">
                <h3 class="text-xl font-bold mb-2">🚚 Fast Delivery</h3>
                <p class="text-gray-500">Quick and reliable shipping worldwide.</p>
            </div>

            <div class="p-6 rounded-xl hover:bg-white hover:shadow transition">
                <h3 class="text-xl font-bold mb-2">🔒 Secure Payments</h3>
                <p class="text-gray-500">Your transactions are fully protected.</p>
            </div>

            <div class="p-6 rounded-xl hover:bg-white hover:shadow transition">
                <h3 class="text-xl font-bold mb-2">⭐ Premium Quality</h3>
                <p class="text-gray-500">Only the best products curated for you.</p>
            </div>

        </div>
    </section>


    <!-- CTA -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-24 text-center">

        <h2 class="text-4xl font-bold mb-6">
            Start Your Journey Today
        </h2>

        <p class="text-blue-100 mb-8">
            Join thousands of satisfied customers worldwide.
        </p>

        <a href="{{ route('register') }}"
            class="bg-white text-blue-600 px-8 py-3 rounded-xl font-semibold shadow hover:bg-gray-100">
            Create Account
        </a>

    </section>


    <!-- FOOTER -->
    <footer class="bg-slate-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-12">

            <div>
                <h3 class="text-white font-bold mb-3 text-lg">MyShop</h3>
                <p class="text-sm">Premium ecommerce experience for modern shoppers.</p>
            </div>

            <div>
                <h3 class="text-white font-bold mb-3">Company</h3>
                <p class="text-sm hover:text-white cursor-pointer">About</p>
                <p class="text-sm hover:text-white cursor-pointer">Careers</p>
                <p class="text-sm hover:text-white cursor-pointer">Contact</p>
            </div>

            <div>
                <h3 class="text-white font-bold mb-3">Support</h3>
                <p class="text-sm hover:text-white cursor-pointer">Help Center</p>
                <p class="text-sm hover:text-white cursor-pointer">Returns</p>
                <p class="text-sm hover:text-white cursor-pointer">Privacy Policy</p>
            </div>

        </div>

        <div class="text-center text-sm mt-12 text-gray-500">
            © {{ date('Y') }} MyShop. All rights reserved.
        </div>
    </footer>

</x-layouts.landing-layout>
