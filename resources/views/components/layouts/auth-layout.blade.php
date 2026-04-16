<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    @vite('resources/css/app.css')

    <style>
        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeSlide {
            animation: fadeSlide 0.6s ease-out;
        }
    </style>

</head>

<body class="min-h-screen flex items-center justify-center bg-white">

    <div class="w-full max-w-md p-6 rounded-2xl bg-blue-900 border border-blue-800 shadow-xl">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-white">E-Commerce</h1>
            <p class="text-sm text-blue-200">Welcome back 👋</p>
        </div>

        {{ $slot }}

    </div>

</body>

</body>

</html>
