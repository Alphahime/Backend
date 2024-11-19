<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rappel de votre réservation</title>
</head>
<body>
    <h1>Bonjour {{ $reservation->client->name }}</h1>
    <p>Nous vous rappelons que votre réservation pour la séance avec le coach {{ $reservation->coach->name }} est prévue pour le {{ \Carbon\Carbon::parse($reservation->date_seance)->format('d/m/Y H:i') }}.</p>
    <p>Nous vous encourageons à être à l'heure pour profiter pleinement de votre séance.</p>
</body>
</html>
