<x-layouts.landing-layout>

    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6">

            <!-- TITLE -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">
                    Our Products
                </h1>
                <p class="text-gray-500 mt-4">
                    Discover our latest and trending items
                </p>
            </div>

            <!-- GRID -->
            <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-10">

                @for ($i = 1; $i <= 8; $i++)
                    <div
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden hover:-translate-y-2">

                        <!-- IMAGE -->
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300"></div>

                            <!-- BADGE -->
                            <span
                                class="absolute top-3 left-3 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow">
                                New
                            </span>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-5">

                            <h3 class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition">
                                Product {{ $i }}
                            </h3>

                            <!-- RATING (UI LANG) -->
                            <div class="flex items-center text-yellow-400 text-sm mt-1">
                                ★★★★☆
                                <span class="text-gray-400 ml-2">(4.0)</span>
                            </div>

                            <!-- PRICE -->
                            <p class="text-xl font-bold text-gray-900 mt-3">
                                $ {{ rand(50, 150) }}
                            </p>

                            <!-- BUTTON -->
                            <a href="{{ route('products.show', $i) }}"
                                class="block mt-5 w-full text-center bg-blue-600 text-white py-2.5 rounded-xl font-medium hover:bg-blue-700 transition">
                                View Details
                            </a>

                        </div>
                    </div>
                @endfor

            </div>

        </div>
    </section>

</x-layouts.landing-layout>
