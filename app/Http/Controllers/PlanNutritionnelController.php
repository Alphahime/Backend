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
 *     required={"id", "nom", "description"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nom", type="string", example="Plan de perte de poids"),
 *     @OA\Property(property="description", type="string", example="Un plan nutritionnel conçu pour aider à perdre du poids."),
 *     @OA\Property(property="type_alimentation", type="string", example="Régime"),
 *     @OA\Property(property="calories_totale", type="string", example="1500 kcal"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="ingredients", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="etapes", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="image", type="string", example="URL de l'image")
 * )
 *
 * @OA\Schema(
 *     schema="StorePlanNutritionnelRequest",
 *     type="object",
 *     required={"nom", "description", "type_alimentation", "calories_totale", "ingredients", "etapes"},
 *     @OA\Property(property="nom", type="string", example="Plan de prise de masse"),
 *     @OA\Property(property="description", type="string", example="Un plan nutritionnel conçu pour aider à prendre de la masse."),
 *     @OA\Property(property="type_alimentation", type="string", example="Régime"),
 *     @OA\Property(property="calories_totale", type="string", example="2000 kcal"),
 *     @OA\Property(property="image", type="string", example="URL de l'image"),
 *     @OA\Property(property="ingredients", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="etapes", type="array", @OA\Items(type="string"))
 * )
 *
 * @OA\Schema(
 *     schema="UpdatePlanNutritionnelRequest",
 *     type="object",
 *     required={"nom", "description"},
 *     @OA\Property(property="nom", type="string", example="Plan de perte de poids modifié"),
 *     @OA\Property(property="description", type="string", example="Un plan modifié pour aider à perdre du poids."),
 *     @OA\Property(property="type_alimentation", type="string", example="Régime"),
 *     @OA\Property(property="calories_totale", type="string", example="1500 kcal"),
 *     @OA\Property(property="image", type="string", example="URL de l'image"),
 *     @OA\Property(property="ingredients", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="etapes", type="array", @OA\Items(type="string"))
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
        
        // Décoder les ingrédients et étapes
        foreach ($plans as $plan) {
            $plan->ingredients = json_decode($plan->ingredients, true);
            $plan->etapes = json_decode($plan->etapes, true);
        }

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
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'type_alimentation' => 'required|string|max:255',
        'calories_totale' => 'required|string|max:255',
        'ingredients' => 'required|json',
        'etapes' => 'required|json',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Create the plan nutritionnel
    $recette = new PlanNutritionnel();
    $recette->nom = $request->nom;
    $recette->description = $request->description;
    $recette->type_alimentation = $request->type_alimentation;
    $recette->calories_totale = $request->calories_totale;
    $recette->ingredients = json_encode($request->ingredients);
    $recette->etapes = json_encode($request->etapes);

    // Handle image upload
    if ($request->hasFile('image')) {
        $recette->image = $this->uploadImage($request->file('image'));
    }

    $recette->save();

    return response()->json(['message' => 'Recette ajoutée avec succès', 'recette' => $recette], 201);
}


    /**
     * Upload l'image et retourne le chemin
     */
    private function uploadImage($image)
    {
        if ($image) {
            
            $path = $image->store('images', 'public'); 
            return '/storage/' . $path; 
        }
        return null; 
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
        $plan = PlanNutritionnel::find($id);
    
        if (!$plan) {
            return response()->json(['message' => 'Plan nutritionnel non trouvé.'], 404);
        }
    
        // Décoder les ingrédients et étapes
        $plan->ingredients = json_decode($plan->ingredients, true);
        $plan->etapes = json_decode($plan->etapes, true);
    
        return response()->json($plan, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/plans-nutritionnels/{id}",
     *     tags={"Plans Nutritionnels"},
     *     summary="Mettre à jour un plan nutritionnel existant",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdatePlanNutritionnelRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plan nutritionnel mis à jour avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/PlanNutritionnel")
     *     ),
     *     @OA\Response(response=404, description="Plan nutritionnel non trouvé.")
     * )
     */
    public function update(UpdatePlanNutritionnelRequest $request, $id)
{
    $plan = PlanNutritionnel::find($id);

    if (!$plan) {
        return response()->json(['message' => 'Plan nutritionnel non trouvé.'], 404);
    }

    // Validation des données
    $validatedData = $request->validated();

    // Mettre à jour le plan nutritionnel
    $plan->update([
        'nom' => $validatedData['nom'],
        'description' => $validatedData['description'],
        'type_alimentation' => $validatedData['type_alimentation'],
        'calories_totale' => $validatedData['calories_totale'],
        'image' => $this->uploadImage($request->file('image')) ?? $plan->image, // Mettre à jour l'image ou garder l'ancienne
        'ingredients' => json_encode($validatedData['ingredients']),
        'etapes' => json_encode($validatedData['etapes']),
        'date_creation' => now(),
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
     *         response=204,
     *         description="Plan nutritionnel supprimé avec succès."
     *     ),
     *     @OA\Response(response=404, description="Plan nutritionnel non trouvé.")
     * )
     */
    public function destroy($id)
    {
        $plan = PlanNutritionnel::find($id);
    
        if (!$plan) {
            return response()->json(['message' => 'Plan nutritionnel non trouvé.'], 404);
        }
    
        $plan->delete();
    
        return response()->json(null, 204);
    }
}
