<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Coaching", description="Opérations liées au coaching")
 */
class CoachingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/coaching",
     *     tags={"Coaching"},
     *     summary="Lister tous les coachings",
     *     @OA\Response(response="200", description="Liste des coachings")
     * )
     */
    public function index()
    {
        $coachings = Coaching::with('user')->get(); 
        return response()->json([
            'success' => true,
            'data' => $coachings
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/coaching",
     *     tags={"Coaching"},
     *     summary="Créer un nouveau coaching",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string", example="Coaching en ligne"),
     *             @OA\Property(property="description", type="string", example="Description du coaching"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response="201", description="Coaching créé avec succès"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id', 
        ]);

        $coaching = Coaching::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $coaching
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/coaching/{id}",
     *     tags={"Coaching"},
     *     summary="Afficher un coaching spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du coaching", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Détails du coaching"),
     *     @OA\Response(response="404", description="Coaching non trouvé")
     * )
     */
    public function show($id)
    {
        $coaching = Coaching::with('user')->find($id); 

        if (!$coaching) {
            return response()->json(['success' => false, 'message' => 'Coaching non trouvé.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $coaching
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/coaching/{id}",
     *     tags={"Coaching"},
     *     summary="Mettre à jour un coaching spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du coaching", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string", example="Coaching avancé"),
     *             @OA\Property(property="description", type="string", example="Description mise à jour du coaching"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response="200", description="Coaching mis à jour avec succès"),
     *     @OA\Response(response="404", description="Coaching non trouvé"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function update(Request $request, $id)
    {
        $coaching = Coaching::find($id);

        if (!$coaching) {
            return response()->json(['success' => false, 'message' => 'Coaching non trouvé.'], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id', 
        ]);

        $coaching->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $coaching
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/coaching/{id}",
     *     tags={"Coaching"},
     *     summary="Supprimer un coaching spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du coaching", @OA\Schema(type="integer")),
     *     @OA\Response(response="204", description="Coaching supprimé avec succès"),
     *     @OA\Response(response="404", description="Coaching non trouvé")
     * )
     */
    public function destroy($id)
    {
        $coaching = Coaching::find($id);

        if (!$coaching) {
            return response()->json(['success' => false, 'message' => 'Coaching non trouvé.'], 404);
        }

        $coaching->delete();

        return response()->json(['success' => true, 'message' => 'Coaching supprimé avec succès.']);
    }
}
