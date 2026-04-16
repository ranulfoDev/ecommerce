<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

            <input type="text" name="name" value="{{ $product->name }}" class="border p-2 rounded w-full">

            <input type="number" name="price" value="{{ $product->price }}" class="border p-2 rounded w-full">

            <input type="number" name="stock" value="{{ $product->stock }}" class="border p-2 rounded w-full">

            <select name="category_id" class="border p-2 rounded w-full">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <textarea name="description" class="border p-2 rounded w-full mt-4">{{ $product->description }}</textarea>

        <input type="file" name="image" class="mt-4">

        <button class="bg-green-500 text-white px-4 py-2 mt-4 rounded">
            Update
        </button>

    </form>

</x-layouts.admin-layout>
