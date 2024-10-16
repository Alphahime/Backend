<!DOCTYPE html>
<html>
<head>
    <title>Coach Acceptance Email</title>
</head>
<body>
    <h1>Congratulations, {{ $user->name }}!</h1>
    <p>Your coach profile has been accepted. You can now log in to your account using the following details:</p>
    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Temporary Password: {{ $temporaryPassword }}</li>
    </ul>
    <p>Please log in and update your password as soon as possible.</p>
    <p>Thank you for joining our platform!</p>
</body>
</html>
