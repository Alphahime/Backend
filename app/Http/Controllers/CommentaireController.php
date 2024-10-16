<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use App\Models\Commentaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(name="Commentaires", description="Opérations liées aux commentaires")
 *
 * @OA\Schema(
 *     schema="Commentaire",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="content", type="string", example="Ceci est un commentaire."),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="StoreCommentaireRequest",
 *     type="object",
 *     required={"content"},
 *     @OA\Property(property="content", type="string", example="Ceci est un commentaire.")
 * )
 *
 * @OA\Schema(
 *     schema="UpdateCommentaireRequest",
 *     type="object",
 *     required={"content"},
 *     @OA\Property(property="content", type="string", example="Ceci est un commentaire modifié.")
 * )
 */
class CommentaireController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/commentaires",
     *     tags={"Commentaires"},
     *     summary="Lister tous les commentaires",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des commentaires récupérée avec succès.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Commentaire"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $commentaires = Commentaire::all();
        return response()->json($commentaires);
    }

    /**
     * @OA\Post(
     *     path="/api/commentaires",
     *     tags={"Commentaires"},
     *     summary="Créer un nouveau commentaire",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCommentaireRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Commentaire créé avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/Commentaire")
     *     )
     * )
     */
    public function store(StoreCommentaireRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();  
    
        
        $commentaire = Commentaire::create($validatedData);
        return response()->json($commentaire, 201);
    }
    

    /**
     * @OA\Get(
     *     path="/api/commentaires/{id}",
     *     tags={"Commentaires"},
     *     summary="Afficher un commentaire spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Commentaire récupéré avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/Commentaire")
     *     ),
     *     @OA\Response(response=404, description="Commentaire non trouvé.")
     * )
     */
    public function show(Commentaire $commentaire): JsonResponse
    {
        return response()->json($commentaire);
    }

    /**
     * @OA\Put(
     *     path="/api/commentaires/{id}",
     *     tags={"Commentaires"},
     *     summary="Mettre à jour un commentaire spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCommentaireRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Commentaire mis à jour avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/Commentaire")
     *     ),
     *     @OA\Response(response=403, description="Action non autorisée.")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/commentaires/{id}",
     *     tags={"Commentaires"},
     *     summary="Supprimer un commentaire spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=204,
     *         description="Commentaire supprimé avec succès."
     *     ),
     *     @OA\Response(response=403, description="Action non autorisée.")
     * )
     */
    public function destroy(Commentaire $commentaire): JsonResponse
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

        $commentaire->delete();

        return response()->json([
            'success' => true,
            'message' => 'Commentaire supprimé avec succès.'
        ], 204);
    }
}
