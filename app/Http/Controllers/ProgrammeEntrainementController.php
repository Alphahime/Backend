<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeEntrainement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
 */
class ProgrammeEntrainementController extends Controller
{
    public function index(): JsonResponse
    {
        $programmes = ProgrammeEntrainement::all();
        return response()->json($programmes);
    }

    public function store(Request $request): JsonResponse
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string',
            'frequence' => 'required|string',
            'niveau_difficulte' => 'required|string',
            'type_programme' => 'required|in:en ligne,presentiel',
            'status' => 'required|in:actif,inactif',
            'date_creation' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'domaine_sportif_id' => 'required|exists:domaine_sportifs,id',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Gestion de l'upload d'image
            $validated = $validator->validated();
            if ($request->hasFile('images')) {
                $path = $request->file('images')->store('programmes', 'public');
                $validated['images'] = $path;
            }

            $programme = ProgrammeEntrainement::create($validated);
            return response()->json($programme, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'ajout du programme: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Récupérer un programme d'entraînement avec ses séances
        $programme = ProgrammeEntrainement::with('seancesEntrainement')->findOrFail($id);

        // Retourner les données, par exemple sous forme JSON
        return response()->json($programme);
    }
    

    public function update(Request $request, ProgrammeEntrainement $programmeEntrainement): JsonResponse
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string',
            'frequence' => 'required|string',
            'niveau_difficulte' => 'required|string',
            'type_programme' => 'required|in:en ligne,presentiel',
            'status' => 'required|in:actif,inactif',
            'date_creation' => 'nullable|date',
            'date_mise_a_jour' => 'nullable|date',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'domaine_sportif_id' => 'required|exists:domaine_sportifs,id',
            'categorie_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // Handle image upload if exists
        if ($request->hasFile('images')) {
            // Delete old image if exists
            if ($programmeEntrainement->images) {
                Storage::disk('public')->delete($programmeEntrainement->images);
            }
            $path = $request->file('image')->store('images', 'public');
            $validated['images'] = $path;
        }

        $programmeEntrainement->update($validated);
        return response()->json($programmeEntrainement);
    }

    public function destroy($id): JsonResponse
    {
        $programmeEntrainement = ProgrammeEntrainement::find($id);

        if (!$programmeEntrainement) {
            return response()->json(['message' => 'Programme non trouvé.'], 404);
        }

        // Delete associated image if exists
        if ($programmeEntrainement->images) {
            Storage::disk('public')->delete($programmeEntrainement->images);
        }

        $programmeEntrainement->delete();
        return response()->json(['message' => 'Programme d\'entrainement supprimé avec succès.'], 200);
    }
}
