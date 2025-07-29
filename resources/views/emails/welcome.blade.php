<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .header {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px 20px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #0d6efd;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to {{ config('app.name') }}</h1>
        </div>

        <div class="content">
            <p>Hi {{ $user->name ?? 'there' }},</p>

            <p>We're thrilled to have you on board! 🎉</p>

            <p>Thank you for joining <strong>{{ config('app.name') }}</strong>. We're committed to providing you with the best experience possible. You can now explore our features, connect with the community, and enjoy what we offer.</p>

        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
