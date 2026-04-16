<x-layouts.admin-layout>

    <h1 class="text-2xl font-bold mb-4">Product Management</h1>

    <a href="{{ route('admin.products.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded">
        + Add Product
    </a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-center">Name</th>
                <th class="p-2 text-center">Price</th>
                <th class="p-2 text-center">Stock</th>
                <th class="p-2 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-t">
                    <td class="p-2 text-center">{{ $product->name }}</td>
                    <td class="p-2 text-center">₱{{ $product->price }}</td>
                    <td class="p-2 text-center">{{ $product->stock }}</td>
                    <td class="p-2 text-center">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500">Edit</a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layouts.admin-layout>
