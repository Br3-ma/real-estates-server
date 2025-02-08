<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sqaure - Real Estate Technology Solutions in Zambia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6A4C93',
                        secondary: '#8E7CC3',
                        accent: '#C06C84',
                    },
                },
            },
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-white">
    <header class="text-white bg-primary">
        <div class="container flex items-center justify-between px-4 py-6 mx-auto">
            <div class="flex items-center">
                <img src="{{ asset('public/images/logo.png') }}" alt="Square Logo" class="w-12 h-12 p-1 mr-4 bg-white rounded-full">
                <h1 class="text-3xl font-bold">Square</h1>
            </div>
            <nav class="hidden md:block">
                <a href="{{ route('dashboard') }}" class="mx-3 text-white transition duration-300 hover:text-accent">Dashboard</a>
                {{-- <a href="#features" class="mx-3 text-white transition duration-300 hover:text-accent">Features</a>
                <a href="#contact" class="mx-3 text-white transition duration-300 hover:text-accent">Contact</a> --}}
                <a href="{{ route('privacy-policy') }}" class="mx-3 text-white transition duration-300 hover:text-accent">Privacy Policy</a>
            </nav>
            <button class="text-white md:hidden focus:outline-none">
                <i class="text-2xl fas fa-bars"></i>
            </button>
        </div>
    </header>

    {{ $slot }}
        {{-- @livewireScripts --}}
</body>
</html>
