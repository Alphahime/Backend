<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Programme Assigné</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        .container {
            padding: 20px;
            background-color: #fff;
            margin: 0 auto;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 2px solid #f4f4f4;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .footer {
            border-top: 2px solid #f4f4f4;
            margin-top: 20px;
            padding-top: 10px;
            font-size: 0.9em;
            color: #777;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Bonjour {{ $user->nom }},</h2>
        </div>

        <p>Votre coach vous a assigné un nouveau programme d'entraînement :</p>
        
        <h3>{{ $programme->nom }}</h3>
        
        <p><strong>Description :</strong> {{ $programme->description }}</p>
        <p><strong>Durée :</strong> {{ $programme->duree }}</p>
        <p><strong>Fréquence :</strong> {{ $programme->frequence }}</p>
        <p><strong>Niveau de difficulté :</strong> {{ $programme->niveau_difficulte }}</p>
        <p><strong>Type de programme :</strong> {{ ucfirst($programme->type_programme) }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($programme->status) }}</p>

        <p>Vous pouvez consulter votre programme dans l'application en cliquant sur le lien ci-dessous :</p>
        
        <p><a href="{{ url('/programmes/' . $programme->id) }}" class="btn">Voir le Programme</a></p>

        <div class="footer">
            <p>Merci de votre engagement !</p>
            <p>L'équipe de CoachingApp</p>
        </div>
    </div>
</body>
</html>
