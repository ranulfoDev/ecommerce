<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Panel</title>

    {{-- VITE CSS --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex flex-col min-h-screen">

        <!-- NAVBAR -->
        @include('partials.user.navbar')

        <div class="flex flex-1 gap-4 px-4">

            <!-- SIDEBAR -->
            @include('partials.user.sidebar')

            <!-- CONTENT SLOT -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div>

        <!-- FOOTER -->
        @include('partials.user.footer')

    </div>
    <script>
        function toggleWishlist(id) {
            alert("Added to wishlist product ID: " + id);

            // TODO (optional backend)
            // fetch('/wishlist/' + id, { method: 'POST' })
        }
    </script>



</body>

</html>
