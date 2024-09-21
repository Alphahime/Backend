<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RessourceController extends Controller
{
    // Affiche la liste des ressources (GET /api/ressources)
    public function index(): JsonResponse
    {
        $ressources = Ressource::all();
        return response()->json([
            'success' => true,
            'data' => $ressources
        ]);
    }

    // Crée une nouvelle ressource (POST /api/ressources)
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type_ressource' => 'required|string',
            'titre' => 'required|string',
            'description' => 'required|string',
            'lien' => 'required|url',
            'domaine_sportif_id' => 'required|integer|exists:domaine_sportifs,id',
            'user_id' => 'required|integer|exists:users,id', 
        ]);
    
        $ressource = Ressource::create($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Ressource créée avec succès.',
            'data' => $ressource
        ], 201); 
    }
    

    // Affiche une ressource spécifique (GET /api/ressources/{id})
    public function show(Ressource $ressource): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $ressource
        ]);
    }

    // Met à jour une ressource (PUT /api/ressources/{id})
    public function update(Request $request, Ressource $ressource): JsonResponse
    {
        $validated = $request->validate([
            'type_ressource' => 'required|string',
            'titre' => 'required|string',
            'description' => 'required|string',
            'lien' => 'required|url',
            'domaine_sportif_id' => 'required|integer|exists:domaine_sportifs,id',
        ]);

        $ressource->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ressource mise à jour avec succès.',
            'data' => $ressource
        ]);
    }

    // Supprime une ressource (DELETE /api/ressources/{id})
    public function destroy(Ressource $ressource)
    {
        $ressource->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Ressource supprimée avec succès.'
        ]);
    }
}
