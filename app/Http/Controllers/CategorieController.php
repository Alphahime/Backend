<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorieController extends Controller
{
    public function index()
    {
        return Categorie::with('programmeEntrainements')->get();
    }

    public function store(StoreCategorieRequest $request)
    {
        $validatedData = $request->validated();
    
        // Vérifiez si 'domaine_sportif_id' est présent dans les données validées
        if (!array_key_exists('domaine_sportif_id', $validatedData)) {
            return response()->json(['error' => 'Le champ domaine_sportif_id est requis'], 400);
        }
    
        // Création de la catégorie avec les données validées
        $categorie = Categorie::create([
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
            'domaine_sportif_id' => $validatedData['domaine_sportif_id']
        ]);
    
        return response()->json($categorie, Response::HTTP_CREATED);
    }
    
    
    public function show(Categorie $categorie)
    {
        $categorie->load('programmeEntrainements'); 
        return response()->json($categorie);
    }

    public function update(StoreCategorieRequest $request, Categorie $categorie)
    {
        $validatedData = $request->validated();
        $categorie->update($validatedData);

        return response()->json($categorie);
    }

    public function destroy(Categorie $categorie)
    {
        // Vérifier si la catégorie existe
        if (!$categorie) {
            return response()->json(['error' => 'Catégorie non trouvée.'], Response::HTTP_NOT_FOUND);
        }

        try {
            // Supprimer la catégorie
            $categorie->delete();

            // Retourner une réponse avec code 204 No Content si la suppression est réussie
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            // Gérer les exceptions et retourner une réponse d'erreur
            return response()->json(['error' => 'Erreur lors de la suppression de la catégorie.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
