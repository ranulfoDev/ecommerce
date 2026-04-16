<x-layouts.user-layout>

    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="flex items-center gap-6">
                <img src="https://i.pravatar.cc/100" class="w-24 h-24 rounded-full border-4 border-gray-200">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </h2>
                    <p class="text-gray-500">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <hr class="my-6">

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-500">Full Name</p>
                    <p class="font-semibold">{{ auth()->user()->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email Address</p>
                    <p class="font-semibold">{{ auth()->user()->email }}</p>
                </div>

            </div>

        </div>

    </div>

</x-layouts.user-layout>
