<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgrammeEntrainementRequest;
use App\Http\Requests\UpdateProgrammeEntrainementRequest;
use App\Models\ProgrammeEntrainement;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(name="Programmes d'Entraînement", description="Opérations liées aux programmes d'entraînement")
 *
 * @OA\Schema(
 *     schema="ProgrammeEntrainement",
 *     type="object",
 *     required={"id", "title", "description"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Programme de Force"),
 *     @OA\Property(property="description", type="string", example="Un programme d'entraînement axé sur le développement de la force."),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="StoreProgrammeEntrainementRequest",
 *     type="object",
 *     required={"title", "description"},
 *     @OA\Property(property="title", type="string", example="Programme d'Endurance"),
 *     @OA\Property(property="description", type="string", example="Un programme d'entraînement conçu pour améliorer l'endurance.")
 * )
 *
 * @OA\Schema(
 *     schema="UpdateProgrammeEntrainementRequest",
 *     type="object",
 *     required={"title", "description"},
 *     @OA\Property(property="title", type="string", example="Programme de Force Modifié"),
 *     @OA\Property(property="description", type="string", example="Un programme d'entraînement modifié axé sur le développement de la force.")
 * )
 */
class ProgrammeEntrainementController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/programmes-entrainement",
     *     tags={"Programmes d'Entraînement"},
     *     summary="Lister tous les programmes d'entraînement",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des programmes d'entraînement récupérée avec succès.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ProgrammeEntrainement"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $programmes = ProgrammeEntrainement::all();
        return response()->json($programmes);
    }

    /**
     * @OA\Post(
     *     path="/api/programmes-entrainement",
     *     tags={"Programmes d'Entraînement"},
     *     summary="Créer un nouveau programme d'entraînement",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreProgrammeEntrainementRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Programme d'entraînement créé avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/ProgrammeEntrainement")
     *     )
     * )
     */
    public function store(StoreProgrammeEntrainementRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $programme = ProgrammeEntrainement::create($validated);
        return response()->json($programme, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/programmes-entrainement/{id}",
     *     tags={"Programmes d'Entraînement"},
     *     summary="Afficher un programme d'entraînement spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du programme d'entraînement récupérés avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/ProgrammeEntrainement")
     *     ),
     *     @OA\Response(response=404, description="Programme d'entraînement non trouvé.")
     * )
     */
    public function show(ProgrammeEntrainement $programmeEntrainement): JsonResponse
    {
        return response()->json($programmeEntrainement);
    }

    /**
     * @OA\Put(
     *     path="/api/programmes-entrainement/{id}",
     *     tags={"Programmes d'Entraînement"},
     *     summary="Mettre à jour un programme d'entraînement",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateProgrammeEntrainementRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Programme d'entraînement mis à jour avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/ProgrammeEntrainement")
     *     )
     * )
     */
    public function update(UpdateProgrammeEntrainementRequest $request, ProgrammeEntrainement $programmeEntrainement): JsonResponse
    {
        $validated = $request->validated();
        $programmeEntrainement->update($validated);
        return response()->json($programmeEntrainement);
    }

    /**
     * @OA\Delete(
     *     path="/api/programmes-entrainement/{id}",
     *     tags={"Programmes d'Entraînement"},
     *     summary="Supprimer un programme d'entraînement",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Programme d'entraînement supprimé avec succès."
     *     ),
     *     @OA\Response(response=404, description="Programme d'entraînement non trouvé.")
     * )
     */
    public function destroy($id): JsonResponse
    {
        $programmeEntrainement = ProgrammeEntrainement::find($id);
    
        if (!$programmeEntrainement) {
            return response()->json(['message' => 'Programme non trouvé.'], 404);
        }
    
        $programmeEntrainement->delete();
        return response()->json(['message' => 'Programme d\'entrainement supprimé avec succès.'], 200);
    }
}
