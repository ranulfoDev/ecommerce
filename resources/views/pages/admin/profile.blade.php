<x-layouts.admin-layout>

    <div class="p-6">

        <h2 class="text-2xl font-bold mb-6">👤 Admin Profile</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- PROFILE CARD -->
                <div class="bg-white shadow rounded-xl p-6 text-center">

                    <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : 'https://i.pravatar.cc/100' }}"
                        class="w-24 h-24 mx-auto rounded-full mb-4 object-cover">

                    <input type="file" name="image" class="text-sm">

                </div>

                <!-- SETTINGS -->
                <div class="bg-white shadow rounded-xl p-6 md:col-span-2">

                    <h3 class="font-semibold text-lg mb-4">Account Settings</h3>

                    <div class="space-y-4">

                        <div>
                            <label>Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}"
                                class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <button class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
                            Save Changes
                        </button>

                    </div>

                </div>

            </div>
        </form>

    </div>

</x-layouts.admin-layout>
