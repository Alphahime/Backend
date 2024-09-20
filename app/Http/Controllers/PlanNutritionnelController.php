<?php

namespace App\Http\Controllers;

use App\Models\PlanNutritionnel;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlanNutritionnelRequest;
use App\Http\Requests\UpdatePlanNutritionnelRequest;

class PlanNutritionnelController extends Controller
{
    // Lister tous les plans nutritionnels
    public function index()
    {
        $plans = PlanNutritionnel::all();
        return response()->json($plans, 200); // Renvoyer la liste des plans sous format JSON
    }

    // Créer un nouveau plan nutritionnel
    public function store(StorePlanNutritionnelRequest $request)
    {
        $plan = PlanNutritionnel::create($request->validated());
        return response()->json([
            'message' => 'Plan Nutritionnel créé avec succès.',
            'plan' => $plan
        ], 201);
    }

    // Afficher un plan spécifique
    public function show(PlanNutritionnel $plan)
    {
        return response()->json($plan, 200); // Renvoyer les détails du plan sous format JSON
    }

    public function update(UpdatePlanNutritionnelRequest $request, PlanNutritionnel $plan)
    {
        $plan->update($request->validated());
    
        return response()->json([
            'message' => 'Plan nutritionnel mis à jour avec succès.',
            'plan' => $plan
        ], 200);
    }
    
    // Supprimer un plan nutritionnel
    public function destroy(PlanNutritionnel $plan)
    {
        $plan->delete();
        return response()->json([
            'message' => 'Plan Nutritionnel supprimé avec succès.'
        ], 200); // Renvoyer une réponse JSON pour confirmer la suppression
    }
}
