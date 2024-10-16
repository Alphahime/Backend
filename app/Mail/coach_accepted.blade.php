<!DOCTYPE html>
<html>
<head>
    <title>Vos accès au dashboard</title>
</head>
<body>
    <h1>Bienvenue, {{ $name }}</h1>
    <p>Vous avez été accepté en tant que coach. Vous pouvez accéder à votre dashboard avec les identifiants suivants :</p>
    <p>Email : {{ $email }}</p>
    <p>Mot de passe temporaire : password_temporaire</p>
    <p><a href="{{ url('/login') }}">Cliquez ici pour vous connecter</a></p>
</body>
</html>
