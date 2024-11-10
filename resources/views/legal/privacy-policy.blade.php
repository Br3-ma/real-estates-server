<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Square - Privacy Policy</title>
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
                <img src="/api/placeholder/80/80" alt="Square Logo" class="w-12 h-12 rounded-full mr-4 bg-white p-1">
                <h1 class="text-3xl font-bold">Square</h1>
            </div>
            <nav class="hidden md:block">
                <a href="{{ route('home') }}" class="text-white hover:text-accent mx-3 transition duration-300">Home</a>
                {{-- <a href="#" class="text-white hover:text-accent mx-3 transition duration-300">Features</a>
                <a href="#" class="text-white hover:text-accent mx-3 transition duration-300">Contact</a> --}}
                <a href="{{ route('privacy-policy') }}" class="text-white hover:text-accent mx-3 transition duration-300">Privacy Policy</a>
            </nav>
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12">
        <section class="text-center mb-20">
            <h2 class="text-5xl font-bold mb-6 text-primary">Privacy Policy</h2>
            <p class="text-xl mb-10 text-gray-600 max-w-3xl mx-auto">Your privacy is our top priority. Learn how we protect your personal information while providing innovative real estate solutions in Zambia.</p>
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
            <img src="/api/placeholder/1200/600" alt="Privacy and Security" class="w-full h-auto rounded-xl mt-12 shadow-2xl">
        </section>

        <section class="mb-20">
            <div class="bg-gray-50 p-8 rounded-xl shadow-lg mb-8">
                <p class="text-sm text-gray-600 mb-4">Last Updated: September 28, 2024</p>
                <p class="mb-6">Welcome to Square, Zambia's premier real estate technology solution. Our mission is to revolutionize property management, buying, selling, and renting for all Zambians. This privacy policy outlines how we collect, use, and protect your information, ensuring you have full control over your data while enjoying our innovative real estate services.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold mb-4 text-primary">1. Who We Are</h3>
                    <p>Sqaure is a cutting-edge real estate technology company based in Lusaka, Zambia. Our innovative platform seamlessly connects users with a wide array of real estate opportunities across the nation, leveraging the latest in PropTech to make property transactions smoother and more accessible.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold mb-4 text-primary">2. Information We Collect</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Personal Information:</strong> Name, email, phone number, and address</li>
                        <li><strong>Property Information:</strong> Listings, preferences, and search history</li>
                        <li><strong>Usage Data:</strong> Interactions with our platform and services</li>
                        <li><strong>Device Information:</strong> Type of device, operating system, and browser</li>
                    </ul>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold mb-4 text-primary">3. How We Use Your Information</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Provide personalized property listings and services</li>
                        <li>Enhance and optimize your user experience</li>
                        <li>Respond promptly to inquiries and support requests</li>
                        <li>Maintain and improve platform security</li>
                        <li>Comply with legal and regulatory requirements</li>
                        <li>Analyze market trends and user behavior to improve our offerings</li>
                    </ul>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-semibold mb-4 text-primary">4. Your Privacy Rights</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Access and review your personal data</li>
                        <li>Correct any inaccuracies in your information</li>
                        <li>Request deletion of your data (subject to legal requirements)</li>
                        <li>Opt-out of marketing communications</li>
                        <li>Restrict certain data processing activities</li>
                        <li>Request a copy of your data in a portable format</li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="contact" class="bg-gray-50 p-12 rounded-xl shadow-xl">
            <h3 class="text-3xl font-bold mb-8 text-primary">Contact Us</h3>
            <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-full md:w-1/2 md:pr-8">
                    <p class="mb-6 text-gray-600">We value your feedback and are here to address any questions or concerns regarding this Privacy Policy. Please don't hesitate to reach out:</p>
                    <div class="space-y-4 text-gray-600">
                        <p><i class="fas fa-envelope text-accent mr-2"></i> <strong>Email:</strong> info@square.twalitso.com</p>
                        <p><i class="fas fa-phone text-accent mr-2"></i> <strong>Phone:</strong> +260 970 123 456</p>
                        <p><i class="fas fa-map-marker-alt text-accent mr-2"></i> <strong>Address:</strong> Square Real Estate Technology, 123 Independence Avenue, Lusaka, Zambia</p>
                    </div>
                </div>
                <div class="w-full md:w-1-2 mt-8 md:mt-0">
                    <img src="/api/placeholder/600/400" alt="Contact Us" class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-primary text-white py-8 mt-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-center">
                <div class="w-full md:w-1/3 text-center md:text-left mb-6 md:mb-0">
                    <img src="/api/placeholder/80/80" alt="Square Logo" class="w-12 h-12 rounded-full inline-block bg-white p-1">
                    <span class="text-2xl font-bold ml-2">Square</span>
                </div>
                <div class="w-full md:w-1/3 text-center mb-6 md:mb-0">
                    <p>&copy; 2024 Twalisto Innovations. All rights reserved.</p>
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
