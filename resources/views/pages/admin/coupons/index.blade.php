<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-6">Coupons</h2>

    <form action="{{ route('admin.coupons.store') }}" method="POST" class="grid grid-cols-3 gap-2 mb-6">
        @csrf

        <input name="code" placeholder="Code" class="border p-2 rounded">
        <input name="discount" placeholder="Discount" class="border p-2 rounded">
        <input type="date" name="expires_at" class="border p-2 rounded">
        <button class="bg-blue-500 text-white col-span-3 p-2 rounded">Create</button>
    </form>

    @foreach ($coupons as $c)
        <div class="flex justify-between p-3 bg-white mb-2 rounded shadow">
            <span>{{ $c->code }} - {{ $c->discount }}%</span>
            <form method="POST" action="{{ route('admin.coupons.destroy', $c) }}">
                @csrf @method('DELETE')
                <button class="bg-red-500 text-white px-2 rounded">Delete</button>
            </form>
        </div>
    @endforeach

</x-layouts.admin-layout>
