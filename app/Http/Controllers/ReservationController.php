<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; // Make sure to import Auth facade
use Illuminate\Http\Request; // Importation de la classe Request

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
            'status' => 'nullable|in:pending,confirmed,completed',
        ]);
    
        try {
            $validatedData = $request->only(['coach_id', 'date_seance', 'status']);
            $validatedData['user_id'] = Auth::id();
    
            $reservation = Reservation::create($validatedData);
    
            // Chargez la relation coach explicitement
            $reservation->load('coach');
    
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

        if ($reservation->status === 'completed') {
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
}
