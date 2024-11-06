@component('mail::message')
# Confirmation de votre réservation

Bonjour {{ $reservation->client->name }},

Nous sommes heureux de vous informer que votre réservation avec le coach {{ $reservation->coach->name }} pour le {{ $reservation->date_seance }} a été confirmée.

Merci de votre confiance et à très bientôt !

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
