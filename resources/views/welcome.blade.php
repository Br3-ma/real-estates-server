<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Square - Your Real Estate Companion</title>
    
    <!-- Core UI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
    
    <!-- Google Fonts - Poppins for a modern look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('https://svgshare.com/i/ZBE.svg') no-repeat center center;
            background-size: 50% 50%;
            animation: rotate 20s linear infinite;
            opacity: 0.1;
        }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .download-section {
            background-color: #f8f9fa;
            padding: 100px 0;
        }
        .contact-section {
            padding: 100px 0;
        }
        .footer {
            background-color: #3c4b64;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body class="c-app">
    <div class="c-wrapper">
        <div class="c-body">
            <main class="c-main">
                <section id="home" class="hero-section">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="display-4 font-weight-bold">Find Your Dream Home with Square</h1>
                                <p class="lead">Discover, explore, and secure your perfect property effortlessly.</p>
                            </div>
                            <div class="col-md-6">
                                <img src="https://svgshare.com/i/ZBF.svg" alt="3D House Illustration" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </section>

                <section id="download" class="download-section">
                    <div class="container">
                        <h2 class="text-center mb-5">Get Started Today</h2>
                        <p class="text-center mb-5">Download the Square app and begin your journey to finding your dream home.</p>
                        <div class="text-center">
                            <a href="https://expo.dev/artifacts/eas/c3DHNKeRhnytAvGMkPo3ep.apk" class="btn btn-primary btn-lg">
                                <i class="fas fa-download mr-2"></i> Download Square App
                            </a>
                        </div>
                    </div>
                </section>

                {{-- <section id="contact" class="contact-section">
                    <div class="container">
                        <h2 class="text-center mb-5">Contact Us</h2>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form id="contact-form">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section> --}}
            </main>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2024 Square Real Estate App. All rights reserved.</p>
        </div>
    </footer>

    <!-- Core UI JavaScript -->
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
    <script src="public/script.js"></script>
</body>
</html>