<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management - Welcome {{ $user->name }}</title>
    <style>
        /* Add your custom CSS styles here for better email rendering */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #666;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Your Company!</h1>
        <p>Dear {{ $user->name }},</p>
        <p>Thank you for joining us. We're thrilled to have you on board!</p>
        <p>To get started, please click the button below:</p>
        <a href="{{ route('verify.email', ['id' => $user->id, 'hash' => $user->email_verification_token]) }}">Verify
            Email</a>
        <p>If you have any questions or need assistance, feel free to contact our support team.</p>
        <p>Best regards,<br>Your Company Team</p>
    </div>
</body>

</html>
