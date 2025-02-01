<!DOCTYPE html>
<html>

<head>
    <title>Elegant Media-support-ticket</title>
</head>

<body>
    <h3>{{ $details['title'] }}</h3>
    <p>Dear Valued Customer,</p>
    <p>{{ $details['body'] }}</p>
    <p>Status: <strong>{{ $details['status']}} <strong></p>
    <p>Our support agent will reach out you soon.</p>
    <p>This is an auto generated email. Please do not reply</p>
    <p>Thank you!</p>

</body>

</html>
