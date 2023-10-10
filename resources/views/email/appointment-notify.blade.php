<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Appointment Notification</h2>
        <p><strong>Booking ID:</strong> {{ $appointment->booking_id }}</p>
        <p><strong>Patient Name:</strong> {{ $patient_name }}</p>
        <p><strong>Appointment Date:</strong> {{ $appointment->appointment_date }}</p>
        <p><strong>Appointment Time:</strong> {{ $appointment->appointment_time }}</p>
        <p><strong>Description:</strong> {{ $appointment->description }}</p>
        <p><strong>Appointment Type:</strong> {{ $appointment->appointment_type }}</p>
        <p><strong>Created At:</strong> {{ $appointment->created_at }}</p>

        <div class="footer">
            <p>Thank you for choosing our services. If you have any questions, feel free to contact us.</p>
        </div>
    </div>
</body>

</html>
