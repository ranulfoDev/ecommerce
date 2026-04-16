<x-layouts.admin-layout>

    <h2 class="text-2xl font-bold mb-2">User Management</h2>

    <!-- SUCCESS MESSAGE -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- USERS TABLE -->
    <div class="bg-white p-5 rounded shadow">
        <table class="w-full text-sm text-center">
            <thead>
                <tr class="border-b text-center">
                    <th class="py-2">Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b">
                        <td class="py-2 text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->email }}</td>

                        <td class="text-center">
                            @if ($user->status === 'blocked')
                                <span class="text-red-500 font-semibold">Blocked</span>
                            @else
                                <span class="text-green-500 font-semibold">Active</span>
                            @endif
                        </td>

                        <td class="py-2 text-center">
                            <div class="flex items-center justify-center gap-2">

                                @if ($user->status === 'active')
                                    <a href="{{ route('admin.users.block', $user->id) }}"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs">
                                        Block
                                    </a>
                                @else
                                    <a href="{{ route('admin.users.activate', $user->id) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded text-xs">
                                        Activate
                                    </a>
                                @endif

                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-gray-800 text-white px-3 py-1 rounded text-xs">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

</x-layouts.admin-layout>
