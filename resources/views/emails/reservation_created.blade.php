<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            padding: 20px;
            margin: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .status {
            font-weight: bold;
            color: #007BFF;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Nouvelle réservation pour votre séance</h1>

        @if ($reservation->coach)
            <p>Bonjour <strong>{{ $reservation->coach->name }}</strong>,</p>
        @else
            <p>Bonjour Coach,</p>
        @endif

        @if ($reservation->client)
            <p>Une nouvelle réservation a été effectuée par <strong>{{ $reservation->client->name }}</strong> pour la séance du <strong>{{ $reservation->date_seance }}</strong>.</p>
        @else
            <p>Une nouvelle réservation a été effectuée pour la séance du <strong>{{ $reservation->date_seance }}</strong>.</p>
        @endif

        <p>Status : <span class="status">{{ ucfirst($reservation->status) }}</span></p>

        <p>Merci de gérer cette réservation depuis votre espace coach.</p>

        <p><a href="{{ url('/coach/reservations') }}" class="button">Voir les réservations</a></p>

        <div class="footer">
            <p>Si vous avez des questions, contactez-nous à tout moment.</p>
            <p>Merci,</p>
            <p>L'équipe de gestion des réservations</p>
        </div>
    </div>
</body>
</html>
