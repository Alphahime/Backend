<!DOCTYPE html>
<html>
<head>
    <title>Email d'acceptation de coach</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .button-link {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .button-link:hover {
            background-color: #45a049;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Félicitations {{ $user->name }} !</h1>
        <p>Votre profil de coach a été accepté. Vous pouvez maintenant vous connecter à votre compte en utilisant les informations suivantes :</p>
        <ul>
            <li><strong>Email :</strong> {{ $user->email }}</li>
            <li><strong>Mot de passe temporaire :</strong> {{ $temporaryPassword }}</li>
        </ul>
        <p>Veuillez vous connecter et mettre à jour votre mot de passe dès que possible.</p>
        <p>
            <a href="https://monprojet-123.vercel.app" class="button-link">Accéder à votre compte</a>
        </p>
        <p class="footer">Merci de rejoindre notre plateforme !</p>
    </div>
</body>
</html>
