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
<body class="bg-[#6A4C93] text-gray-800 ">
    <header class="bg-primary text-white">
        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('public/images/logo.png') }}" alt="Square Logo" class="w-12 h-12 rounded-full mr-4 bg-white p-1">
                <h1 class="text-3xl font-bold">Square</h1>
            </a>
            <nav class="hidden md:block">
                <a href="{{ route('dashboard') }}" class="text-white hover:text-accent mx-3 transition duration-300">Dashboard</a>
                {{-- <a href="#features" class="text-white hover:text-accent mx-3 transition duration-300">Features</a>
                <a href="#contact" class="text-white hover:text-accent mx-3 transition duration-300">Contact</a> --}}
                <a href="{{ route('privacy-policy') }}" class="text-white hover:text-accent mx-3 transition duration-300">Privacy Policy</a>
            </nav>
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-primary mb-4">Privacy Policy</h1>
        <p class="mb-4">This privacy policy applies to the Square app (hereby referred to as "Application") for mobile devices created by Twalitso Innovations Ltd (hereby referred to as "Service Provider") as a Commercial service. This service is intended for use "AS IS".</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Information Collection and Use</h2>
        <p class="mb-4">The Application collects information when you download and use it, including:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Your device's Internet Protocol (IP) address.</li>
            <li>The pages of the Application you visit, the time and date of your visit, and the time spent on those pages.</li>
            <li>The operating system used on your mobile device.</li>
            <li>Your device's location to provide the following services:
                <ul class="list-disc ml-6 mt-2">
                    <li><strong>Geolocation Services:</strong> To offer personalized content, recommendations, and location-based services.</li>
                    <li><strong>Analytics and Improvements:</strong> To analyze user behavior, identify trends, and improve Application performance.</li>
                    <li><strong>Third-Party Services:</strong> Transmit anonymized location data to enhance and optimize the Application.</li>
                </ul>
            </li>
        </ul>
        <p class="mb-4">The Service Provider may contact you to provide important information, notices, and marketing promotions. Personally identifiable information (such as email, user ID, password, and phone) may be requested and retained in accordance with this privacy policy.</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Third Party Access</h2>
        <p class="mb-4">Aggregated, anonymized data may be shared with third-party services to improve the Application and its offerings. The Application uses third-party services with their own Privacy Policies:</p>
        <ul class="list-disc ml-6 mb-4">
            <li><a href="https://policies.google.com/privacy" target="_blank" class="text-accent underline">Google Play Services</a></li>
            <li><a href="https://support.google.com/admob/answer/6128543?hl=en" target="_blank" class="text-accent underline">AdMob</a></li>
            <li><a href="https://www.facebook.com/policy.php" target="_blank" class="text-accent underline">Facebook</a></li>
            <li><a href="https://expo.dev/privacy" target="_blank" class="text-accent underline">Expo</a></li>
        </ul>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Disclosure of Information</h2>
        <p class="mb-4">User Provided and Automatically Collected Information may be disclosed:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>As required by law or to comply with legal processes.</li>
            <li>To protect the rights, safety of users, or investigate fraud.</li>
            <li>To trusted service providers who act on the Service Provider's behalf and adhere to this privacy policy.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Opt-Out Rights</h2>
        <p class="mb-4">You can stop all collection of information by uninstalling the Application through your device's standard uninstall processes.</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Data Retention Policy</h2>
        <p class="mb-4">User data is retained while you use the Application and for a reasonable time after. To request the deletion of data provided, contact: <a href="mailto:nyeleti.bremah@gmail.com" class="text-accent underline">nyeleti.bremah@gmail.com</a>.</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Children</h2>
        <p class="mb-4">The Application does not knowingly collect data from children under 13. If personal information from a child under 13 is discovered, it will be deleted immediately. Parents or guardians aware of such data collection should contact: <a href="mailto:nyeleti.bremah@gmail.com" class="text-accent underline">nyeleti.bremah@gmail.com</a>.</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Security</h2>
        <p class="mb-4">The Service Provider uses physical, electronic, and procedural safeguards to protect user information.</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Changes to This Policy</h2>
        <p class="mb-4">The Privacy Policy may be updated periodically. Changes will be notified by updating this page. Continued use indicates acceptance of changes. This policy is effective as of 2024-11-10.</p>

        <h2 class="text-2xl font-semibold text-secondary mt-6 mb-2">Your Consent</h2>
        <p>By using the Application, you consent to the processing of your information as outlined in this policy.</p>

        <br>
        <br>
        <br>
        <hr>
        <br>
        <div>
            <p>
                Contact Us
        If you have any questions regarding privacy while using the Application, or have questions about the practices, please contact the Service Provider via email at nyeleti.bremah@gmail.com.
            </p>
        </div>
    </div>
</body>
</html>
