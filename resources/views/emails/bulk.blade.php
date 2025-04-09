<!DOCTYPE html>
<html>
<head>
    <title>{{ $subjectLine ?? 'Job Portal Notification' }}</title>
</head>
<body>
    <p>{!! nl2br(e($content)) !!}</p>
</body>
</html>
