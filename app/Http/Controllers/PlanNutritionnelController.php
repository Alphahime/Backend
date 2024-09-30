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
        // Validation des données
        $validatedData = $request->validated();
    
        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('plans_images', 'public');
            $validatedData['image'] = $imagePath; // Stocker le chemin de l'image
        }
    
        // Créer le plan nutritionnel
        $plan = PlanNutritionnel::create([
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
            'type_alimentation' => $validatedData['type_alimentation'],
            'calories_totale' => $validatedData['calories_totale'],
            'image' => $validatedData['image'] ?? null,
            'ingredient' => json_encode($validatedData['ingredient']), // Encoder en JSON
            'etape_a_suivre' => json_encode($validatedData['etape_a_suivre']), // Encoder en JSON
            'date_creation' => now(),
        ]);
    
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
    public function show($id)
    {
        $recette = PlanNutritionnel::find($id);
    
        if (!$recette) {
            return response()->json(['message' => 'Recette not found'], 404);
        }
    
        return response()->json($recette);
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
    // Validation des données
    $validatedData = $request->validated();

    // Gestion de l'upload d'image si une nouvelle image est fournie
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('plans_images', 'public');
        $validatedData['image'] = $imagePath; 
    }

    // Mise à jour du plan nutritionnel
    $plan->update([
        'nom' => $validatedData['nom'],
        'description' => $validatedData['description'],
        'type_alimentation' => $validatedData['type_alimentation'],
        'calories_totale' => $validatedData['calories_totale'],
        'image' => $validatedData['image'] ?? $plan->image, 
        'ingredient' => json_decode($validatedData['ingredient']),
        'etape_a_suivre' => json_decode($validatedData['etape_a_suivre']), 
        'date_mise_a_jour' => now(),
    ]);

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
        if (!$plan) {
            return response()->json(['message' => 'Plan nutritionnel non trouvé.'], 404);
        }
    
        $plan->delete();
        return response()->json([
            'message' => 'Plan Nutritionnel supprimé avec succès.'
        ], 200);
    }
    
    
}
