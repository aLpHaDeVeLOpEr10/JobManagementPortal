<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Confirmation</title>
</head>
<body>
    <h1>Job Application Submitted</h1>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for applying for the position of <strong>{{ $job->title }}</strong> at <strong>{{ $job->company }}</strong>.</p>
    <p>We appreciate your interest in joining our team. Our hiring team will review your application and get back to you shortly.</p>
    <p>Best regards,</p>
    <p>The {{ config('app.name') }} Team</p>
</body>
</html>
