<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ReservationCreated;
use App\Notifications\ReservationCompleted;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $reservation = Reservation::create($validatedData);

        $coach = $reservation->coach;
        if ($coach) {
            Mail::to($coach->email)->send(new ReservationCreated($reservation));
        }

        return response()->json($reservation, 201);
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
                Mail::to($client->email)->send(new ReservationCompleted($reservation));
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
