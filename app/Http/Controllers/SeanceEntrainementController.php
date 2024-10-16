<?php

namespace App\Http\Controllers;

use App\Models\SeanceEntrainement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSeanceEntrainementRequest;
use App\Http\Requests\UpdateSeanceEntrainementRequest;

/**
 * @OA\Schema(
 *     schema="SeanceEntrainement",
 *     type="object",
 *     @OA\Property(property="nom", type="string", example="Séance Musculation Matin"),
 *     @OA\Property(property="description", type="string", example="Séance d'entraînement de musculation en matinée."),
 *     @OA\Property(property="duree", type="string", example="1h"),
 *     @OA\Property(property="chronometre", type="string", example="30 minutes"),
 *     @OA\Property(property="ordre", type="integer", example=1),
 *     @OA\Property(property="programme_entrainement_id", type="integer", example=1),
 *     @OA\Property(property="date_mise_a_jour", type="string", format="date-time", example="2024-09-21T02:48:57Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-09-21T02:48:57Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-09-21T02:48:57Z")
 * )
 */

class SeanceEntrainementController extends Controller
{
    /**
     * @OA\Get(
     *     path="/seances",
     *     tags={"Séances d'Entraînement"},
     *     summary="Lister toutes les séances d'entraînement",
     *     @OA\Response(response="200", description="Liste des séances d'entraînement")
     * )
     */
    public function index()
    {
        $seances = SeanceEntrainement::all();
        return response()->json($seances); // Retourne la liste au format JSON
    }

    /**
     * @OA\Post(
     *     path="/seances",
     *     tags={"Séances d'Entraînement"},
     *     summary="Créer une nouvelle séance d'entraînement",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SeanceEntrainement")
     *     ),
     *     @OA\Response(response="201", description="Séance d'entraînement créée avec succès")
     * )
     */
    public function store(StoreSeanceEntrainementRequest $request)
    {
        // Créez la séance en incluant le programme d'entraînement ID
        $seance = SeanceEntrainement::create($request->validated());
        return response()->json($seance, 201); // Retourne la nouvelle séance créée
    }

    /**
     * @OA\Put(
     *     path="/seances/{id}",
     *     tags={"Séances d'Entraînement"},
     *     summary="Mettre à jour une séance d'entraînement",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la séance d'entraînement", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SeanceEntrainement")
     *     ),
     *     @OA\Response(response="200", description="Séance d'entraînement mise à jour avec succès")
     * )
     */
    public function update(UpdateSeanceEntrainementRequest $request, SeanceEntrainement $seance)
    {
        // Met à jour la séance avec les données validées
        $seance->update($request->validated());
        return response()->json($seance); // Retourne la séance mise à jour
    }

    /**
     * @OA\Delete(
     *     path="/seances/{id}",
     *     tags={"Séances d'Entraînement"},
     *     summary="Supprimer une séance d'entraînement",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la séance d'entraînement", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Séance d'entraînement supprimée avec succès")
     * )
     */
    public function destroy(SeanceEntrainement $seance)
    {
        $seance->delete();
        return response()->json(['message' => 'Séance d\'Entrainement supprimée avec succès.']); // Retourne un message de succès
    }
}
