<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use App\Models\Commentaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    // Display a list of all commentaires
    public function index(): JsonResponse
    {
        $commentaires = Commentaire::all();
        return response()->json($commentaires);
    }

    public function store(StoreCommentaireRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $commentaire = Commentaire::create($validatedData);
        return response()->json($commentaire, 201);
    }

    // Show a specific commentaire
    public function show(Commentaire $commentaire): JsonResponse
    {
        return response()->json($commentaire);
    }

    // Update a specific commentaire
 // Update a specific commentaire
public function update(UpdateCommentaireRequest $request, Commentaire $commentaire): JsonResponse
{
    $user = Auth::user();

    if ($user === null) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Please log in.'
        ], 401);
    }

    if ($commentaire->user_id !== $user->id) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized action.'
        ], 403);
    }

    $validatedData = $request->validated();
    $commentaire->update($validatedData);
    return response()->json($commentaire);
}

public function destroy(Commentaire $commentaire): JsonResponse
{
    $user = Auth::user();

    // Vérifier si l'utilisateur est authentifié
    if ($user === null) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Please log in.'
        ], 401);
    }

    // Vérifier si l'utilisateur est le propriétaire du commentaire
    if ($commentaire->user_id !== $user->id) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized action.'
        ], 403);
    }

    // Supprimer le commentaire
    $commentaire->delete();

    // Retourner une réponse avec le code de statut 204 No Content
    return response()->json([
        'success' => true,
        'message' => 'Commentaire supprimé avec succès.'
    ], 204);
}


    
}
