@component('mail::message')
# Annulation de votre réservation

Bonjour {{ $reservation->client->name }},

Nous vous informons que votre réservation avec le coach {{ $reservation->coach->name }} prévue pour le {{ $reservation->date_seance }} a été annulée.

N'hésitez pas à nous contacter pour toute question.

Merci,<br>
{{ config('app.name') }}
@endcomponent
