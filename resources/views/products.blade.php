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
            @php
                $products = [
                    ['id' => 1, 'name' => 'System Unit gaming', 'price' => 120, 'image' => 'system unit gaming.png'],
                    ['id' => 2, 'name' => 'Monitor gaming', 'price' => 150, 'image' => 'monitor gaming.png'],
                    ['id' => 3, 'name' => 'Mouse gaming', 'price' => 60, 'image' => 'mouse gaming.png'],
                    ['id' => 4, 'name' => 'Key board gaming', 'price' => 110, 'image' => 'key board gaming.png'],
                    ['id' => 5, 'name' => 'Head phone gaming', 'price' => 90, 'image' => 'head phone gaming.png'],
                    ['id' => 6, 'name' => 'Chair gaming', 'price' => 80, 'image' => 'chair gaming.png'],
                    ['id' => 7, 'name' => 'Webcam', 'price' => 70, 'image' => 'webcam.png'],
                    ['id' => 8, 'name' => 'Laptop gaming', 'price' => 55, 'image' => 'laptop gaming.png'],
                ];
            @endphp

            <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-10">

                @foreach ($products as $product)
                    <div
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden hover:-translate-y-2">

                        <!-- IMAGE -->
                        <div class="relative">
                            <img src="{{ asset('storage/products/' . $product['image']) }}"
                                class="h-48 w-full object-cover">

                            <!-- BADGE -->
                            <span
                                class="absolute top-3 left-3 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow">
                                New
                            </span>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-5">

                            <h3 class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition">
                                {{ $product['name'] }}
                            </h3>

                            <!-- RATING -->
                            <div class="flex items-center text-yellow-400 text-sm mt-1">
                                ★★★★☆
                                <span class="text-gray-400 ml-2">(4.0)</span>
                            </div>

                            <!-- PRICE -->
                            <p class="text-xl font-bold text-gray-900 mt-3">
                                ${{ $product['price'] }}
                            </p>

                            <!-- BUTTON -->
                            <a href="{{ route('products.show', $product['id']) }}"
                                class="block mt-5 w-full text-center bg-blue-600 text-white py-2.5 rounded-xl font-medium hover:bg-blue-700 transition">
                                View Details
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>
    </section>

</x-layouts.landing-layout>
