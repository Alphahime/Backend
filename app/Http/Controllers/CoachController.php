<?php


namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;

/**
 * @OA\Tag(
 *     name="Coaches",
 *     description="API Endpoints pour les coachs"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Coach",
 *     type="object",
 *     title="Coach",
 *     required={"user_id", "profil_verifie"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID du coach"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="ID de l'utilisateur associé"
 *     ),
 *     @OA\Property(
 *         property="profil_verifie",
 *         type="boolean",
 *         description="Statut de vérification du profil"
 *     ),
 *     @OA\Property(
 *         property="experience",
 *         type="string",
 *         description="Détails de l'expérience du coach"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Description du coach"
 *     ),
 *     @OA\Property(
 *         property="lieu",
 *         type="string",
 *         description="Lieu du coach"
 *     ),
 *     @OA\Property(
 *         property="services",
 *         type="object",
 *         description="Services offerts par le coach",
 *         example={"coaching": "Développement personnel", "mentorat": "Entrepreneuriat"}
 *     ),
 *     @OA\Property(
 *         property="galerie_photos",
 *         type="array",
 *         @OA\Items(type="string", format="url"),
 *         description="Galerie de photos du coach"
 *     ),
 *     @OA\Property(
 *         property="diplomes",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="Diplômes ou certifications du coach"
 *     ),
 *     @OA\Property(
 *         property="disponibilites",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="Disponibilités du coach"
 *     )
 * )
 */
class CoachController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/coaches",
     *     operationId="storeCoach",
     *     tags={"Coaches"},
     *     summary="Créer un nouveau coach",
     *     description="Créer un nouveau coach avec les informations fournies",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCoachRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Coach créé avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Coach")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides"
     *     )
     * )
     */
    public function store(StoreCoachRequest $request)
    {
        $coach = Coach::create($request->validated());
        return response()->json($coach, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/coaches",
     *     operationId="getAllCoaches",
     *     tags={"Coaches"},
     *     summary="Obtenir tous les coachs",
     *     description="Retourne une liste de tous les coachs",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des coachs",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Coach"))
     *     )
     * )
     */
    public function index()
    {
        $coaches = Coach::all();
        return response()->json($coaches);
    }

    /**
     * @OA\Get(
     *     path="/api/coaches/{id}",
     *     operationId="getCoachById",
     *     tags={"Coaches"},
     *     summary="Obtenir les détails d'un coach",
     *     description="Retourne les détails d'un coach spécifique",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID du coach"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du coach",
     *         @OA\JsonContent(ref="#/components/schemas/Coach")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Coach non trouvé"
     *     )
     * )
     */
    public function show($id)
    {
        $coach = Coach::findOrFail($id);
        return response()->json($coach);
    }

   /**
 * @OA\Schema(
 *     schema="UpdateCoachRequest",
 *     type="object",
 *     title="UpdateCoachRequest",
 *     required={"user_id", "profil_verifie"},
 *     @OA\Property(property="user_id", type="integer", description="ID de l'utilisateur associé"),
 *     @OA\Property(property="profil_verifie", type="boolean", description="Statut de vérification du profil"),
 *     @OA\Property(property="experience", type="string", description="Détails de l'expérience du coach"),
 *     @OA\Property(property="description", type="string", description="Description du coach"),
 *     @OA\Property(property="lieu", type="string", description="Lieu du coach"),
 *     @OA\Property(property="services", type="object", description="Services offerts par le coach"),
 *     @OA\Property(property="galerie_photos", type="array", @OA\Items(type="string", format="url"), description="Galerie de photos du coach"),
 *     @OA\Property(property="diplomes", type="array", @OA\Items(type="string"), description="Diplômes ou certifications du coach"),
 *     @OA\Property(property="disponibilites", type="array", @OA\Items(type="string"), description="Disponibilités du coach"),
 * )
 */

    public function update(UpdateCoachRequest $request, $id)
    {
        $coach = Coach::findOrFail($id);
        $coach->update($request->validated());
        return response()->json($coach);
    }

    /**
     * @OA\Delete(
     *     path="/api/coaches/{id}",
     *     operationId="deleteCoach",
     *     tags={"Coaches"},
     *     summary="Supprimer un coach",
     *     description="Supprimer un coach existant",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID du coach"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Coach supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Coach non trouvé"
     *     )
     * )
     */
    public function destroy($id)
    {
        $coach = Coach::findOrFail($id);
        $coach->delete();
        return response()->json(null, 204);
    }
}
