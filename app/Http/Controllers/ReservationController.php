<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ReservationController extends Controller
{
    public function index(): JsonResponse
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'coach_id' => 'required|exists:users,id',
            'date_seance' => 'required|date',
            'status' => 'nullable|in:en_attente,confirme,termine', 
        ]);
    
        try {
            $validatedData = $request->only(['coach_id', 'date_seance', 'status']);
            $validatedData['user_id'] = Auth::id(); 
    
            // Création de la réservation
            $reservation = Reservation::create($validatedData);
    
            // Charger la relation coach
            $reservation->load('coach');
    
            // Envoi de l'email au coach si existe
            if ($reservation->coach) {
                Mail::to($reservation->coach->email)->send(new \App\Mail\ReservationCreated($reservation));
            }
    
            return response()->json($reservation, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Reservation $reservation): JsonResponse
    {
        return response()->json($reservation);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation): JsonResponse
    {
        $validatedData = $request->validated();
        $reservation->update($validatedData);

        if ($reservation->status === 'termine') {
            $client = $reservation->client;
            if ($client) {
                // Mail::to($client->email)->send(new ReservationCompleted($reservation));
            }
        }

        return response()->json($reservation);
    }

    public function destroy(Reservation $reservation): JsonResponse
    {
        $reservation->delete();
        return response()->json(null, 204);
    }

    public function accepterReservation(Reservation $reservation): JsonResponse
    {
        $reservation->update(['status' => 'confirme']);
        
        // Envoi de l'email de confirmation en français
        $client = $reservation->client;
        if ($client) {
            Mail::to($client->email)->send(new \App\Mail\ReservationAcceptee($reservation));
        }

        return response()->json(['message' => 'La réservation a été acceptée et l\'email a été envoyé.']);
    }

    public function annulerReservation(Reservation $reservation): JsonResponse
    {
        $reservation->update(['status' => 'annule']);
        
        // Envoi de l'email d'annulation en français
        $client = $reservation->client;
        if ($client) {
            Mail::to($client->email)->send(new \App\Mail\ReservationAnnulee($reservation));
        }

        return response()->json(['message' => 'La réservation a été annulée et l\'email a été envoyé.']);
    }

    

     public function getUserReservations(): JsonResponse
{
    $user = Auth::user();

    if ($user) {
        // Retrieve reservations where the user is the one who created them
        $reservations = Reservation::where('user_id', $user->id)->get();
        return response()->json($reservations);
    }

    return response()->json(['error' => 'utilisateur non connecté '], 401);
}

public function getCoachReservations($coachId)
{
    try {
        $reservations = Reservation::where('coach_id', $coachId)->get();

        if ($reservations->isEmpty()) {
            return response()->json([
                'message' => 'Aucune réservation trouvée pour ce coach.',
            ], 404);
        }

        return response()->json($reservations, 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur lors de la récupération des réservations.',
            'details' => $e->getMessage(),
        ], 500);
    }
}



public function rappelReservation(): JsonResponse
{
    try {
        // Récupérer toutes les réservations dont la date de la séance est demain
        $reservations = Reservation::whereDate('date_seance', Carbon::today()->addDay(1))->get();

        foreach ($reservations as $reservation) {
            
        $client = $reservation->client;
        if ($client) {
            Mail::to($client->email)->send(new \App\Mail\RappelReservation($reservation));
        }
        }

        return response()->json(['message' => 'Les rappels de réservation ont été envoyés avec succès.']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
