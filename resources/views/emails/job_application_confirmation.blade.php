<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Confirmation</title>
</head>
<body>
    <h1>Application Submitted</h1>
    <p>Dear User,</p>
    <p>You have successfully applied for the job: <strong>{{ $job->title }}</strong> at <strong>{{ $job->company }}</strong>.</p>
    <p>Best of luck!</p>
    <p>Thank you for your application.</p>
</body>
</html>
