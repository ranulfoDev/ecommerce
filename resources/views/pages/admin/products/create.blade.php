<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">Add Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow">
        @csrf

        <div class="grid grid-cols-2 gap-4">

            <input type="text" name="name" placeholder="Product Name" class="border p-2 rounded w-full">

            <input type="number" name="price" placeholder="Price" class="border p-2 rounded w-full">

            <input type="number" name="stock" placeholder="Stock" class="border p-2 rounded w-full">

            <select name="category_id" class="border p-2 rounded w-full">
                <option value="">Select Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

        </div>

        <textarea name="description" placeholder="Description" class="border p-2 rounded w-full mt-4"></textarea>

        <input type="file" name="image" class="mt-4">

        <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">
            Save Product
        </button>

    </form>

</x-layouts.admin-layout>
