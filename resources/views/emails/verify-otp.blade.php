<!DOCTYPE html>
<html>
<head>
    <title>Square OTP Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #7D7399;
            margin: 0;
            padding: 0;
            background-image: url('https://www.example.com/background.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFF;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #543b66;
            color: #FFF;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content p {
            color: #333333;
            line-height: 1.6;
        }
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            color: #555555;
        }
        .footer {
            background-color: #f4f4f9;
            color: #777777;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        .illustration {
            max-width: 100%;
            height: auto;
        }
        .back-to-login {
            margin-top: 20px;
            color: #f4511e;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SQuare | Reset your password </h1>
        </div>
        <div class="content">
            <img src="https://shoppingcartmedia.com/images/forgot-password.png" alt="Illustration" class="illustration"> <!-- Replace with your illustration image URL -->
            <p>Hi {{ $data['name'] }},</p>
            <p>We're here to help you reset your password for your Square account. Use the OTP code below to proceed with resetting your password:</p>
            <h1><strong><b>{{ $data['message'] }}</b></strong></h1>
            <img src="https://png.pngtree.com/png-vector/20221012/ourmid/pngtree-wrong-password-isolated-cartoon-vector-illustrations-png-image_6275940.png" alt="Illustration" class="illustration"> <!-- Replace with your illustration image URL -->
            <p>Square is a leading real estate platform in Zambia where you can find, post, comment, and discover amazing houses. We're committed to providing you with the best service possible.</p>
            <ul>
                <li>{{ $data['email'] }}</li>
            </ul>
            <p>If you didn't request a password reset, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Square. All rights reserved.</p>
            <p>1234 Main Street, Lusaka, Zambia</p>
        </div>
    </div>
</body>
</html>
