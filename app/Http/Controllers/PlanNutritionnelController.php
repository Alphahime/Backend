<?php

namespace App\Http\Controllers;

use App\Models\PlanNutritionnel;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlanNutritionnelRequest;
use App\Http\Requests\UpdatePlanNutritionnelRequest;

/**
 * @OA\Tag(name="Plans Nutritionnels", description="Opérations liées aux plans nutritionnels")
 *
 * @OA\Schema(
 *     schema="PlanNutritionnel",
 *     type="object",
 *     required={"id", "name", "description"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Plan de perte de poids"),
 *     @OA\Property(property="description", type="string", example="Un plan nutritionnel conçu pour aider à perdre du poids."),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="StorePlanNutritionnelRequest",
 *     type="object",
 *     required={"name", "description"},
 *     @OA\Property(property="name", type="string", example="Plan de prise de masse"),
 *     @OA\Property(property="description", type="string", example="Un plan nutritionnel conçu pour aider à prendre de la masse.")
 * )
 *
 * @OA\Schema(
 *     schema="UpdatePlanNutritionnelRequest",
 *     type="object",
 *     required={"name", "description"},
 *     @OA\Property(property="name", type="string", example="Plan de perte de poids modifié"),
 *     @OA\Property(property="description", type="string", example="Un plan modifié pour aider à perdre du poids.")
 * )
 */
class PlanNutritionnelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/plans-nutritionnels",
     *     tags={"Plans Nutritionnels"},
     *     summary="Lister tous les plans nutritionnels",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des plans nutritionnels récupérée avec succès.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PlanNutritionnel"))
     *     )
     * )
     */
    public function index()
    {
        $plans = PlanNutritionnel::all();
        return response()->json($plans, 200); // Renvoyer la liste des plans sous format JSON
    }

    /**
     * @OA\Post(
     *     path="/api/plans-nutritionnels",
     *     tags={"Plans Nutritionnels"},
     *     summary="Créer un nouveau plan nutritionnel",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StorePlanNutritionnelRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Plan nutritionnel créé avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/PlanNutritionnel")
     *     )
     * )
     */
    public function store(StorePlanNutritionnelRequest $request)
    {
        $plan = PlanNutritionnel::create($request->validated());
        return response()->json([
            'message' => 'Plan Nutritionnel créé avec succès.',
            'plan' => $plan
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/plans-nutritionnels/{id}",
     *     tags={"Plans Nutritionnels"},
     *     summary="Afficher un plan spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du plan récupérés avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/PlanNutritionnel")
     *     ),
     *     @OA\Response(response=404, description="Plan nutritionnel non trouvé.")
     * )
     */
    public function show(PlanNutritionnel $plan)
    {
        return response()->json($plan, 200); // Renvoyer les détails du plan sous format JSON
    }

    /**
     * @OA\Put(
     *     path="/api/plans-nutritionnels/{id}",
     *     tags={"Plans Nutritionnels"},
     *     summary="Mettre à jour un plan nutritionnel",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdatePlanNutritionnelRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plan nutritionnel mis à jour avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/PlanNutritionnel")
     *     )
     * )
     */
    public function update(UpdatePlanNutritionnelRequest $request, PlanNutritionnel $plan)
    {
        $plan->update($request->validated());
    
        return response()->json([
            'message' => 'Plan nutritionnel mis à jour avec succès.',
            'plan' => $plan
        ], 200);
    }
    
    /**
     * @OA\Delete(
     *     path="/api/plans-nutritionnels/{id}",
     *     tags={"Plans Nutritionnels"},
     *     summary="Supprimer un plan nutritionnel",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Plan nutritionnel supprimé avec succès."
     *     ),
     *     @OA\Response(response=404, description="Plan nutritionnel non trouvé.")
     * )
     */
    public function destroy(PlanNutritionnel $plan)
    {
        $plan->delete();
        return response()->json([
            'message' => 'Plan Nutritionnel supprimé avec succès.'
        ], 200); // Renvoyer une réponse JSON pour confirmer la suppression
    }
}
