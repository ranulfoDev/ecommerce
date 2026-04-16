<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">Categories</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-2 mb-6">
        @csrf
        <input type="text" name="name" placeholder="Category name" class="border p-2 rounded w-full">
        <button class="bg-blue-500 text-white px-4 rounded">Add</button>
    </form>

    <div class="bg-white shadow rounded">
        @foreach ($categories as $cat)
            <div class="flex justify-between items-center p-4 border-b">

                <!-- ✅ FIXED -->
                <span class="font-medium">
                    {{ $cat->name }}
                </span>

                <div class="flex items-center gap-2">

                    <!-- UPDATE -->
                    <form action="{{ route('admin.categories.update', $cat) }}" method="POST"
                        class="flex gap-2 items-center">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $cat->name }}" class="border p-1 rounded">
                        <button class="bg-yellow-400 px-3 py-1 rounded">Update</button>
                    </form>

                    <!-- DELETE ✅ FIXED -->
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </form>

                </div>

            </div>
        @endforeach
    </div>

</x-layouts.admin-layout>
