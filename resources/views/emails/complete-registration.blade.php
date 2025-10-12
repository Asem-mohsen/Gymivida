<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Gym Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #667eea;
            margin-top: 0;
        }
        .content p {
            margin: 15px 0;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box p {
            margin: 5px 0;
        }
        .info-box strong {
            color: #667eea;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            margin: 20px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .button:hover {
            opacity: 0.9;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .footer p {
            margin: 5px 0;
        }
        .note {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏋️ Gymivida</h1>
            <p>Your Complete Gym Management Solution</p>
        </div>
        
        <div class="content">
            <h2>Hello {{ $contact->name }}!</h2>
            
            <p>Thank you for your interest in Gymivida! We're excited to help you take your gym to the next level.</p>
            
            <p>You've requested to complete your gym registration. We've prepared a personalized registration form for you to provide us with more details about your gym.</p>
            
            <div class="info-box">
                <p><strong>Your Contact Information:</strong></p>
                <p>Name: {{ $contact->name }}</p>
                <p>Email: {{ $contact->email }}</p>
                @if($contact->phone)
                <p>Phone: {{ $contact->phone }}</p>
                @endif
                @if($contact->product)
                <p>Interested Product: {{ $contact->product->name }}</p>
                @endif
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $registrationUrl }}" class="button">Complete Your Registration</a>
            </div>
            
            <div class="note">
                <p><strong>⏰ Important:</strong> This registration link is unique to you and will remain active. Please complete your registration at your earliest convenience.</p>
            </div>
            
            <p>If you have any questions or need assistance, please don't hesitate to reach out to our support team.</p>
            
            <p>Best regards,<br>
            <strong>The Gymivida Team</strong></p>
        </div>
        
        <div class="footer">
            <p><strong>Gymivida</strong> - Complete Gym Management Solution</p>
            <p>New Cairo, Egypt | +20 111 234 5678</p>
            <p>&copy; {{ date('Y') }} Gymivida. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

