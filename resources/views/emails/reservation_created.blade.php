<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle réservation</title>
</head>
<body>
    <h1>Nouvelle réservation pour votre séance</h1>

    @if ($reservation->coach)
        <p>Bonjour {{ $reservation->coach->name }},</p>
    @else
        <p>Bonjour Coach,</p>
    @endif

    @if ($reservation->client)
        <p>Une nouvelle réservation a été effectuée par {{ $reservation->client->name }} pour la séance du {{ $reservation->date_seance }}.</p>
    @else
        <p>Une nouvelle réservation a été effectuée pour la séance du {{ $reservation->date_seance }}.</p>
    @endif

    <p>Status: {{ $reservation->status }}</p>
    <p>Merci de gérer cette réservation depuis votre espace coach.</p>
</body>
</html>
