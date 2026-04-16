<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MyShop</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- NAVBAR -->
    <nav class="sticky top-0 bg-white/70 backdrop-blur-xl border-b border-gray-200 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <h1 class="text-2xl font-extrabold tracking-tight text-blue-600">
                MyShop
            </h1>

            <!-- MENU -->
            <div class="flex gap-6 items-center">

                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    Home
                </a>

                <a href="{{ route('products') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    Products
                </a>

                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow hover:bg-blue-700 transition">
                    Register
                </a>

            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main>
        {{ $slot }}
    </main>

</body>

</html>
