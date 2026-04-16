<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- VITE CSS --}}
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        @include('partials.admin.sidebar')

        <div class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            @include('partials.admin.navbar')

            <!-- CONTENT -->
            <main class="p-6 flex-1 overflow-y-auto">

                <!-- ✅ SUCCESS MESSAGE -->
                @if (session('success'))
                    <div id="successMsg" class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}

            </main>

            <!-- FOOTER -->
            @include('partials.admin.footer')

        </div>

    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('successMsg');
            if (msg) {
                msg.style.transition = "opacity 0.5s";
                msg.style.opacity = "0";
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000);
    </script>

</body>

</html>
