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

        <!-- Hero Section -->
        <main class="container relative px-4 py-16 mx-auto">
          <!-- Floating Elements -->
          <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute w-64 h-64 bg-purple-200 rounded-full top-20 left-10 mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute w-64 h-64 bg-yellow-200 rounded-full top-20 right-10 mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute w-64 h-64 bg-pink-200 rounded-full -bottom-8 left-20 mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
          </div>

          <!-- Hero Content -->
          <section class="relative mb-24 text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-medium bg-violet-100 text-violet-700 rounded-full">
              🇿🇲 Trusted by 10,000+ Zambians
            </span>
            <h1 class="mb-6 text-6xl font-bold text-transparent bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text">
              Your Dream Space Awaits
            </h1>
            <p class="max-w-2xl mx-auto mb-10 text-xl leading-relaxed text-slate-600">
              Finding your perfect property shouldn't be complicated. We've made it as easy as scrolling through your favorite app.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col items-center justify-center gap-4 mb-12 sm:flex-row">
              <a href="#" class="relative inline-flex items-center justify-center w-full px-8 py-3 font-semibold text-white transition-all duration-200 rounded-full group bg-gradient-to-r from-violet-600 to-indigo-600 hover:shadow-lg hover:shadow-violet-500/50 sm:w-auto">
                Find Your Space
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>
              <a href="https://play.google.com/store/apps/details?id=com.br3mah.square" class="inline-flex items-center justify-center w-full px-6 py-3 transition-all duration-200 bg-white border rounded-full text-slate-700 border-slate-200 hover:shadow-lg hover:border-violet-200 sm:w-auto">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                </svg>
                Get the App
              </a>
            </div>

            <!-- Stats Bar -->
            <div class="grid max-w-4xl grid-cols-2 gap-8 p-8 mx-auto shadow-lg md:grid-cols-4 bg-white/80 backdrop-blur-sm rounded-2xl">
              <div class="text-center">
                <div class="text-2xl font-bold text-violet-600">150K+</div>
                <div class="text-slate-600">Active Listings</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-violet-600">98%</div>
                <div class="text-slate-600">Success Rate</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-violet-600">24/7</div>
                <div class="text-slate-600">Support</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-violet-600">4.9★</div>
                <div class="text-slate-600">User Rating</div>
              </div>
            </div>
          </section>

          <!-- Features Section -->
          <section class="relative mb-24">
            <h2 class="mb-12 text-3xl font-bold text-center">Why Choose Square?</h2>
            <div class="grid gap-8 md:grid-cols-3">
              <div class="p-8 transition-all duration-300 shadow-lg group bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
                <div class="flex items-center justify-center w-12 h-12 mb-6 transition-transform rounded-full bg-violet-100 group-hover:scale-110">
                  <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                  </svg>
                </div>
                <h3 class="mb-4 text-xl font-semibold">Smart Search</h3>
                <p class="text-slate-600">Find your perfect match with AI-powered recommendations based on your preferences and lifestyle.</p>
              </div>
              <div class="p-8 transition-all duration-300 shadow-lg group bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
                <div class="flex items-center justify-center w-12 h-12 mb-6 transition-transform rounded-full bg-violet-100 group-hover:scale-110">
                  <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                  </svg>
                </div>
                <h3 class="mb-4 text-xl font-semibold">Market Insights</h3>
                <p class="text-slate-600">Real-time analytics and price predictions to help you make informed decisions at the right time.</p>
              </div>
              <div class="p-8 transition-all duration-300 shadow-lg group bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
                <div class="flex items-center justify-center w-12 h-12 mb-6 transition-transform rounded-full bg-violet-100 group-hover:scale-110">
                  <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
                <h3 class="mb-4 text-xl font-semibold">Easy Payments</h3>
                <p class="text-slate-600">Secure, hassle-free transactions with multiple payment options and instant confirmation.</p>
              </div>
            </div>
          </section>

          <!-- Contact Section -->
          <section class="relative">
            <div class="p-8 shadow-xl bg-white/80 backdrop-blur-sm rounded-2xl md:p-12">
              <div class="flex flex-wrap gap-12 md:flex-nowrap">
                <div class="w-full md:w-1/2">
                  <span class="block mb-2 font-medium text-violet-600">Get in Touch</span>
                  <h3 class="mb-6 text-3xl font-bold">Let's Make Your Property Dreams Reality</h3>
                  <div class="space-y-6">
                    <div class="flex items-center gap-4">
                      <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-violet-100">
                        <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                      </div>
                      <div>
                        <div class="font-medium">Email Us</div>
                        <a href="mailto:info@square.twalitso.com" class="text-violet-600 hover:text-violet-700">info@square.twalitso.com</a>
                      </div>
                    </div>
                    <div class="flex items-center gap-4">
                      <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-violet-100">
                        <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                      </div>
                      <div>
                        <div class="font-medium">Call Us</div>
                        <a href="tel:+260952564843" class="text-violet-600 hover:text-violet-700">+260 952 564 843</a>
                      </div>
                    </div>
                    <div class="flex items-center gap-4">
                      <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-violet-100">
                        <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                      </div>
                      <div>
                        <div class="font-medium">Visit Us</div>
                        <address class="not-italic text-slate-600">Square Real Estate Technology<br/>123 Independence Avenue, Lusaka</address>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-full md:w-1/2">
                  <div class="flex items-center justify-center aspect-video rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100">
                    <span class="text-slate-400">Map View Coming Soon</span>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </main>

        <footer class="pt-16 pb-8 bg-slate-900 text-slate-300">
            <div class="container px-4 mx-auto">
                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 gap-12 mb-16 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Company Info -->
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-12 h-12 bg-white rounded-full">
                                <img src="{{ asset('public/images/logo.png') }}" alt="Square Logo" class="w-10 h-10">
                            </div>
                            <span class="ml-3 text-2xl font-bold text-white">Square</span>
                        </div>
                        <p class="text-slate-400">Revolutionizing real estate technology in Zambia through innovation and accessibility.</p>
                        <div class="space-y-3">
                            <a href="mailto:info@square.twalitso.com" class="flex items-center transition-colors text-slate-400 hover:text-white">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                info@square.twalitso.com
                            </a>
                            <a href="tel:+260952564843" class="flex items-center transition-colors text-slate-400 hover:text-white">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                +260 952 564 843
                            </a>
                            <a href="tel:+260952564843" class="flex items-center transition-colors text-slate-400 hover:text-white">
                                <img class="w-20" src="https://twalitso.com/static/media/logo.a1ab54b465b9a42f9ff5.png">
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="mb-6 text-lg font-semibold text-white">Quick Links</h3>
                        <ul class="space-y-4">
                            <li><a href="/" class="transition-colors hover:text-white">Home</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Properties</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Agents</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">About Us</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Contact</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Blog</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h3 class="mb-6 text-lg font-semibold text-white">Services</h3>
                        <ul class="space-y-4">
                            <li><a href="#" class="transition-colors hover:text-white">Property Search</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Property Management</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Market Analysis</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Investment Advisory</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Mortgage Services</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Legal Assistance</a></li>
                        </ul>
                    </div>

                    <!-- Download & Social -->
                    <div>
                        <h3 class="mb-6 text-lg font-semibold text-white">Get The App</h3>
                        <div class="mb-8 space-y-4">
                            <a href="https://play.google.com/store/apps/details?id=com.br3mah.square"
                               class="flex items-center px-6 py-3 transition-colors rounded-lg bg-slate-800 hover:bg-slate-700">
                                <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                                </svg>
                                Google Play
                            </a>
                            <a href="#" class="flex items-center px-6 py-3 transition-colors rounded-lg bg-slate-800 hover:bg-slate-700">
                                <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
                                </svg>
                                App Store (Coming Soon)
                            </a>
                        </div>
                        <h3 class="mb-6 text-lg font-semibold text-white">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="flex items-center justify-center w-10 h-10 transition-colors rounded-full bg-slate-800 hover:bg-slate-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 transition-colors rounded-full bg-slate-800 hover:bg-slate-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
