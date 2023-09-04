<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; padding: 20px;">

    <div style="background-color: #ffffff; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="font-size: 24px; color: #333;">Password Reset Request</h1>

        <p style="font-size: 16px; color: #333;">Hello,</p>

        <p style="font-size: 16px; color: #333;">We have received a request to reset your account password. To complete
            the process, please use the following code:</p>

        <div style="background-color: #f5f5f5; border-radius: 5px; padding: 10px; margin-top: 20px;">
            <p style="font-size: 18px; color: #333; text-align: center;">{{ $code }}</p>
        </div>

        <p style="font-size: 16px; color: #333;">The code is valid for one hour from the time this email was sent.</p>

        <p style="font-size: 16px; color: #333;">If you did not request a password reset, please ignore this email. Your
            account's security is important to us.</p>

        <p style="font-size: 16px; color: #333;">Thank you for using our service.</p>
    </div>
</body>

</html>
