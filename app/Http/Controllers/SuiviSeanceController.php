<?php

namespace App\Http\Controllers;

use App\Models\SuiviSeance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuiviSeanceController extends Controller
{
    public function index()
{
    $suivis = SuiviSeance::all();

    return response()->json([
        'success' => true,
        'data' => $suivis,
    ], 200);
}


    public function store(Request $request)
    {
        // Validation des données reçues via la requête
        $data = $request->validate([
            'programme_entrainement_id' => 'required|exists:programme_entrainements,id',
            'seance_entrainement_id' => 'required|exists:seance_entrainements,id',
        ]);

        // Ajouter l'utilisateur connecté à la création du suivi de séance
        $data['user_id'] = Auth::id();

        // Créer le suivi de séance
        $suivi = SuiviSeance::create($data);

        // Retourner la réponse JSON après création
        return response()->json([
            'success' => true,
            'message' => 'Suivi de Séance créé avec succès.',
            'data' => $suivi,
        ], 201);
    }

    public function show($id)
    {
        // Récupérer le suivi spécifique avec les relations (séance et programme d'entraînement)
        $suivi = SuiviSeance::with(['seanceEntrainement', 'programmeEntrainement'])
                    ->findOrFail($id);

        // Retourner la réponse JSON
        return response()->json([
            'success' => true,
            'data' => $suivi,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // Valider les données de la requête
        $data = $request->validate([
            'programme_entrainement_id' => 'required|exists:programme_entrainements,id',
            'seance_entrainement_id' => 'required|exists:seance_entrainements,id',
        ]);

        // Trouver le suivi de séance à mettre à jour
        $suivi = SuiviSeance::findOrFail($id);

        // Mettre à jour le suivi avec les nouvelles données
        $suivi->update($data);

        // Retourner la réponse JSON après mise à jour
        return response()->json([
            'success' => true,
            'message' => 'Suivi de Séance mis à jour avec succès.',
            'data' => $suivi,
        ], 200);
    }

    public function destroy($id)
    {
        // Trouver et supprimer le suivi de séance
        $suivi = SuiviSeance::findOrFail($id);
        $suivi->delete();

        // Retourner une réponse JSON après suppression
        return response()->json([
            'success' => true,
            'message' => 'Suivi de Séance supprimé avec succès.',
        ], 200);
    }
}
