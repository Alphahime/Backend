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
        try {
            $validatedData = $request->validated();

            // Si l'utilisateur est connecté, associer son ID
            if (Auth::check()) {
                $validatedData['user_id'] = Auth::id();
            }

            $commentaire = Commentaire::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Commentaire ajouté avec succès.',
                'data' => $commentaire,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du commentaire.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
    public function update(StoreCommentaireRequest $request, Commentaire $commentaire): JsonResponse
    {
        $user = Auth::user();

        if ($user === null) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé. Veuillez vous connecter.'
            ], 401);
        }

        if ($commentaire->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée.'
            ], 403);
        }

        $validatedData = $request->validated();
        $commentaire->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Commentaire mis à jour avec succès.',
            'data' => $commentaire,
        ]);
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
                'message' => 'Non autorisé. Veuillez vous connecter.'
            ], 401);
        }

        if ($commentaire->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée.'
            ], 403);
        }

        $commentaire->delete();

        return response()->json([
            'success' => true,
            'message' => 'Commentaire supprimé avec succès.',
        ]);
    }
}

