<x-layouts.landing-layout>

    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-6">

            <h1 class="text-4xl font-bold mb-6">
                Product {{ $id }}
            </h1>

            <div class="grid md:grid-cols-2 gap-10">

                <div class="h-80 bg-gray-200 rounded-xl"></div>

                <div>
                    <h2 class="text-2xl font-semibold mb-4">
                        Amazing Product {{ $id }}
                    </h2>

                    <p class="text-gray-500 mb-6">
                        This is a detailed description of the product. High quality and worth buying.
                    </p>

                    <p class="text-xl font-bold mb-6">
                        $ {{ rand(50, 150) }}
                    </p>

                    <button class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700">
                        Add to Cart
                    </button>
                </div>

            </div>

        </div>
    </section>

</x-layouts.landing-layout>
