<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

     // Nouvelle fonction pour récupérer les réservations du coach connecté
     public function mesReservations(): JsonResponse
     {
         $user = Auth::user();
 
         // Vérifiez si l'utilisateur est un coach
         if ($user && $user->role === 'coach') {
             $reservations = Reservation::where('coach_id', $user->id)->get();
             return response()->json($reservations);
         }
 
         return response()->json(['error' => 'Accès non autorisé ou utilisateur non coach'], 403);
     }
}
