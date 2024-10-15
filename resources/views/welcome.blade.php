<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RealEst - Real Estate Technology Solutions in Zambia</title>
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
<body class="bg-white text-gray-800 font-sans">
    <header class="bg-primary text-white">
        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <div class="flex items-center">
                <img src="/api/placeholder/80/80" alt="RealEst Logo" class="w-12 h-12 rounded-full mr-4 bg-white p-1">
                <h1 class="text-3xl font-bold">RealEst</h1>
            </div>
            <nav class="hidden md:block">
                <a href="{{ route('home') }}" class="text-white hover:text-accent mx-3 transition duration-300">Dashboard</a>
                {{-- <a href="#features" class="text-white hover:text-accent mx-3 transition duration-300">Features</a>
                <a href="#contact" class="text-white hover:text-accent mx-3 transition duration-300">Contact</a> --}}
                <a href="{{ route('privacy-policy') }}" class="text-white hover:text-accent mx-3 transition duration-300">Privacy Policy</a>
            </nav>
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12">
        <section class="text-center mb-20">
            <h2 class="text-5xl font-bold mb-6 text-primary">Revolutionizing Real Estate in Zambia</h2>
            <p class="text-xl mb-10 text-gray-600 max-w-3xl mx-auto">Simplify property management, buying, selling, and renting with our innovative technology.</p>
            <a href="#" class="bg-accent text-white py-3 px-8 rounded-full text-lg font-semibold hover:bg-opacity-90 transition duration-300 inline-block shadow-lg hover:shadow-xl mb-6">Get Started</a>
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <a href="https://expo.dev/artifacts/eas/7SAa5wZ37hyMTakkUesdLo.apk" class="bg-gray-800 text-white py-2 px-6 rounded-full text-base font-semibold hover:bg-opacity-90 transition duration-300 inline-block shadow-lg hover:shadow-xl">
                    <i class="fas fa-download mr-2"></i>Download APK
                </a>
                <a href="https://expo.dev/artifacts/eas/7SAa5wZ37hyMTakkUesdLo.apk" class="bg-green-600 text-white py-2 px-6 rounded-full text-base font-semibold hover:bg-opacity-90 transition duration-300 inline-block shadow-lg hover:shadow-xl">
                    <i class="fab fa-google-play mr-2"></i>Google Play
                </a>
                {{-- <a href="#" class="bg-blue-500 text-white py-2 px-6 rounded-full text-base font-semibold hover:bg-opacity-90 transition duration-300 inline-block shadow-lg hover:shadow-xl">
                    <i class="fab fa-apple mr-2"></i>App Store
                </a> --}}
            </div>
            <img src="/api/placeholder/1200/600" alt="Zambian Real Estate" class="w-full h-auto rounded-xl mt-12 shadow-2xl">
        </section>

        <section id="features" class="mb-20">
            <h3 class="text-4xl font-bold mb-12 text-center text-primary">Our Features</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <i class="fas fa-home text-5xl mb-6 text-accent"></i>
                    <h4 class="text-2xl font-semibold mb-4 text-primary">Property Listings</h4>
                    <p class="text-gray-600">Browse through a wide range of properties across Zambia. Our comprehensive database includes residential, commercial, and industrial properties.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <i class="fas fa-chart-line text-5xl mb-6 text-accent"></i>
                    <h4 class="text-2xl font-semibold mb-4 text-primary">Market Analysis</h4>
                    <p class="text-gray-600">Get insights on property values and market trends. Our advanced analytics tools provide you with real-time data and forecasts for informed decisions.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <i class="fas fa-handshake text-5xl mb-6 text-accent"></i>
                    <h4 class="text-2xl font-semibold mb-4 text-primary">Easy Transactions</h4>
                    <p class="text-gray-600">Experience streamlined processes for buying, selling, and renting. Our platform simplifies documentation, payments, and communication between parties.</p>
                </div>
            </div>
        </section>

        <section id="contact" class="bg-gray-50 p-12 rounded-xl shadow-xl">
            <h3 class="text-3xl font-bold mb-8 text-primary">Contact Us</h3>
            <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-full md:w-1/2 md:pr-8">
                    <p class="mb-6 text-gray-600">Have questions or need assistance? Our team of real estate experts is here to help you navigate the Zambian property market:</p>
                    <div class="space-y-4 text-gray-600">
                        <p><i class="fas fa-envelope text-accent mr-2"></i> <strong>Email:</strong> info@realest-realestate.co.zm</p>
                        <p><i class="fas fa-phone text-accent mr-2"></i> <strong>Phone:</strong> +260 123 456 789</p>
                        <p><i class="fas fa-map-marker-alt text-accent mr-2"></i> <strong>Address:</strong> RealEst Real Estate Technology, 123 Independence Avenue, Lusaka, Zambia</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 mt-8 md:mt-0">
                    <img src="/api/placeholder/600/400" alt="Contact Us" class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-primary text-white py-8 mt-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-center">
                <div class="w-full md:w-1/3 text-center md:text-left mb-6 md:mb-0">
                    <img src="/api/placeholder/80/80" alt="RealEst Logo" class="w-12 h-12 rounded-full inline-block bg-white p-1">
                    <span class="text-2xl font-bold ml-2">RealEst</span>
                </div>
                <div class="w-full md:w-1/3 text-center mb-6 md:mb-0">
                    <p>&copy; 2024 RealEst Real Estate Technology. All rights reserved.</p>
                </div>
                <div class="w-full md:w-1/3 text-center md:text-right">
                    {{-- <a href="#" class="hover:text-accent mx-2 transition duration-300">Terms of Service</a> --}}
                    <a href="{{ route('privacy-policy') }}" class="hover:text-accent mx-2 transition duration-300">Privacy Policy</a>
                    {{-- <a href="#" class="hover:text-accent mx-2 transition duration-300">Cookie Policy</a> --}}
                </div>
            </div>
        </div>
    </footer>
</body>
</html>