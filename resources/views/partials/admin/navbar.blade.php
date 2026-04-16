<nav class="bg-white shadow-md px-6 py-3 flex justify-between items-center border-b">

    <!-- LEFT -->
    <div class="flex items-center gap-6">
        <h1 class="font-semibold text-lg text-gray-800">
            {{ $title ?? 'Dashboard' }}
        </h1>

        <div class="hidden md:flex items-center bg-gray-100 px-3 py-1.5 rounded-lg">
            <input type="text" placeholder="Search..." class="bg-transparent outline-none text-sm px-2 w-48">
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-5 relative">

        <!-- NOTIF -->
        <button id="notifBtn" class="relative">
            🔔
        </button>

        <!-- NOTIF DROPDOWN -->
        <div id="notifMenu" class="hidden absolute right-24 top-12 w-64 bg-white border rounded-xl shadow-lg p-3">
            <p class="text-sm font-semibold mb-2">Notifications</p>
            <p class="text-xs">🛒 New order</p>
        </div>

        <!-- GMAIL -->
        <button id="gmailBtn">📧</button>

        <!-- GMAIL DROPDOWN -->
        <div id="gmailMenu" class="hidden absolute right-12 top-12 w-64 bg-white border rounded-xl shadow-lg p-3">
            <p class="text-sm font-semibold mb-2">Messages</p>
            <p class="text-xs">Customer message</p>
        </div>

        <!-- PROFILE -->
        <div class="relative">
            <img src="https://i.pravatar.cc/40" class="w-9 h-9 rounded-full cursor-pointer" id="profileBtn">

            <!-- PROFILE DROPDOWN -->
            <div id="dropdownMenu" class="hidden absolute right-0 mt-3 w-44 bg-white border rounded-xl shadow-lg">

                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Profile
                </a>

                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Settings
                </a>


                <form method="POST" action="/logout">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>
<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    const gmailBtn = document.getElementById('gmailBtn');
    const gmailMenu = document.getElementById('gmailMenu');

    const notifBtn = document.getElementById('notifBtn');
    const notifMenu = document.getElementById('notifMenu');

    profileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
        gmailMenu.classList.add('hidden');
        notifMenu.classList.add('hidden');
    });

    gmailBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        gmailMenu.classList.toggle('hidden');
        dropdownMenu.classList.add('hidden');
        notifMenu.classList.add('hidden');
    });

    notifBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notifMenu.classList.toggle('hidden');
        dropdownMenu.classList.add('hidden');
        gmailMenu.classList.add('hidden');
    });

    document.addEventListener('click', () => {
        dropdownMenu.classList.add('hidden');
        gmailMenu.classList.add('hidden');
        notifMenu.classList.add('hidden');
    });
</script>
