<?php
// File: newsletter-broadcast.blade.php
// Path: /resources/views/emails/newsletter-broadcast.blade.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} Newsletter</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #8B5CF6, #A855F7);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 30px 20px;
        }
        .message-content {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }
        .unsubscribe-link {
            color: #8B5CF6;
            text-decoration: none;
        }
        .unsubscribe-link:hover {
            text-decoration: underline;
        }
        .social-links {
            margin: 15px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 5px;
            color: #666;
            text-decoration: none;
            font-size: 18px;
        }
        @media only screen and (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 0;
            }
            .header, .content, .footer {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>{{ config('app.name', 'Furry Friends') }}</h1>
            <p>Your trusted pet adoption platform</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Personalized Greeting -->
            @if($subscriber->name)
                <h2 style="color: #333; margin-top: 0;">Hello {{ $subscriber->name }},</h2>
            @else
                <h2 style="color: #333; margin-top: 0;">Hello Friend,</h2>
            @endif

            <!-- Newsletter Message -->
            <div class="message-content">
                {!! nl2br(e($messageContent)) !!}
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('home') }}" 
                   style="background: linear-gradient(135deg, #8B5CF6, #A855F7); color: white; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                    Visit Our Website
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>{{ config('app.name', 'Furry Friends') }}</strong></p>
            <p>Connecting loving families with pets in need</p>
            
            <!-- Social Links -->
            <div class="social-links">
                <a href="#" title="Facebook">📘</a>
                <a href="#" title="Instagram">📷</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="YouTube">📺</a>
            </div>

            <p>
                You're receiving this email because you subscribed to our newsletter.<br>
                <a href="{{ $unsubscribeUrl }}" class="unsubscribe-link">Unsubscribe</a> | 
                <a href="{{ route('home') }}" class="unsubscribe-link">Visit Website</a>
            </p>
            
            <p style="font-size: 12px; color: #999; margin-top: 15px;">
                {{ config('app.name') }} • 123 Main Street, Anytown, USA<br>
                © {{ date('Y') }} All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>