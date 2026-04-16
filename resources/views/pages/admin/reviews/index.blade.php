<x-layouts.admin-layout>

    <h2 class="text-3xl font-bold mb-6 flex items-center gap-2">
        ⭐ <span>Customer Reviews</span>
    </h2>

    <div class="space-y-4">

        @foreach ($reviews as $r)
            <div class="bg-white border border-gray-200 p-5 rounded-xl shadow-sm hover:shadow-md transition">

                <!-- Header -->
                <div class="flex justify-between items-center mb-2">

                    <!-- Rating -->
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-500 text-lg">
                            {{ str_repeat('★', $r->rating) }}
                        </span>
                        <span class="text-gray-600 text-sm">
                            ({{ $r->rating }}/5)
                        </span>
                    </div>

                    <!-- Status -->
                    @if ($r->approved)
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">
                            ✅ Approved
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">
                            ⏳ Pending
                        </span>
                    @endif

                </div>

                <!-- Comment -->
                <p class="text-gray-700 mt-2 leading-relaxed">
                    {{ $r->comment }}
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    🛍 Product: {{ $r->product->name ?? 'N/A' }}
                </p>

                <p class="text-sm text-gray-500">
                    👤 User: {{ $r->user->name ?? 'Guest' }}
                </p>

                <!-- Actions -->
                <div class="mt-4 flex gap-3">

                    @if (!$r->approved)
                        <a href="{{ route('admin.reviews.approve', $r) }}"
                            class="flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-lg transition">
                            ✔ Approve
                        </a>
                    @endif

                    <form method="POST" action="{{ route('admin.reviews.delete', $r) }}">
                        @csrf @method('DELETE')
                        <button
                            class="flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-lg transition">
                            🗑 Delete
                        </button>
                    </form>

                </div>

            </div>
        @endforeach

    </div>

</x-layouts.admin-layout>
