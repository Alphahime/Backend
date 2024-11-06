<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(name="Ressources", description="Opérations liées aux ressources")
 */
class RessourceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/ressources",
     *     tags={"Ressources"},
     *     summary="Lister toutes les ressources",
     *     @OA\Response(response="200", description="Liste des ressources")
     * )
     */
    public function index(): JsonResponse
    {
        $ressources = Ressource::all(); // Retrieve all resources
        return response()->json([
            'success' => true,
            'data' => $ressources
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/ressources",
     *     tags={"Ressources"},
     *     summary="Créer une nouvelle ressource",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="type_ressource", type="string", example="Article"),
     *             @OA\Property(property="titre", type="string", example="Titre de la ressource"),
     *             @OA\Property(property="description", type="string", example="Description de la ressource"),
     *             @OA\Property(property="lien", type="string", example="http://example.com"),
     *             @OA\Property(property="video", type="string", example="video.mp4"),
     *             @OA\Property(property="image", type="string", example="image.jpg"),
     *             @OA\Property(property="domaine_sportif_id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response="201", description="Ressource créée avec succès"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type_ressource' => 'required|string',
            'titre' => 'required|string',
            'description' => 'required|string',
            'lien' => 'required|url',
            'video' => 'nullable|url',  // Expecting URLs instead of uploaded files
            'image' => 'nullable|url',  // Expecting URLs instead of uploaded files
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
    
    public function update(Request $request, Ressource $ressource): JsonResponse
    {
        $validated = $request->validate([
            'type_ressource' => 'required|string',
            'titre' => 'required|string',
            'description' => 'required|string',
            'lien' => 'required|url',
            'video' => 'nullable|url',  // Expecting URLs
            'image' => 'nullable|url',  // Expecting URLs
            'domaine_sportif_id' => 'required|integer|exists:domaine_sportifs,id',
        ]);
    
        $ressource->update($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Ressource mise à jour avec succès.',
            'data' => $ressource
        ]);
    }
    

    /**
     * @OA\Delete(
     *     path="/api/ressources/{id}",
     *     tags={"Ressources"},
     *     summary="Supprimer une ressource",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la ressource", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Ressource supprimée avec succès"),
     *     @OA\Response(response="404", description="Ressource non trouvée")
     * )
     */
    public function destroy(Ressource $ressource): JsonResponse
    {
        // Delete video if exists
        if ($ressource->video) {
            Storage::delete($ressource->video);
        }

        // Delete image if exists
        if ($ressource->image) {
            Storage::delete($ressource->image);
        }

        $ressource->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ressource supprimée avec succès.'
        ]);
    }
}
