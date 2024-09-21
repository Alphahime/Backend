<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Article",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nom", type="string", example="Titre de l'article"),
 *     @OA\Property(property="description", type="string", example="Description de l'article"),
 *     @OA\Property(property="type_article", type="string", example="Type d'article"),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/articles",
     *     tags={"Articles"},
     *     summary="Liste des articles",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles récupérée avec succès",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Article")
     *         )
     *     ),
     * )
     */
    public function index()
    {
        $articles = Article::with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/articles",
     *     tags={"Articles"},
     *     summary="Créer un nouvel article",
     *     description="Enregistre un nouvel article lié à l'utilisateur authentifié.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom","description","type_article"},
     *             @OA\Property(property="nom", type="string", example="Titre de l'article"),
     *             @OA\Property(property="description", type="string", example="Description de l'article"),
     *             @OA\Property(property="type_article", type="string", example="Type d'article")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Article créé avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Article créé avec succès."),
     *             @OA\Property(property="data", ref="#/components/schemas/Article")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erreur de validation",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Données d'entrée invalides")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'type_article' => 'required|string|max:255',
        ]);

        $article = Article::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'type_article' => $request->type_article,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Article créé avec succès.',
            'data' => $article
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/articles/{id}",
     *     tags={"Articles"},
     *     summary="Afficher un article spécifique",
     *     description="Récupère un article spécifique avec les informations de l'utilisateur associé.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article récupéré avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Article")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article non trouvé",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Article non trouvé")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/articles/{id}",
     *     tags={"Articles"},
     *     summary="Mettre à jour un article",
     *     description="Met à jour un article existant.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom","description","type_article"},
     *             @OA\Property(property="nom", type="string", example="Titre mis à jour"),
     *             @OA\Property(property="description", type="string", example="Nouvelle description de l'article"),
     *             @OA\Property(property="type_article", type="string", example="Nouveau type")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article mis à jour avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Article mis à jour avec succès."),
     *             @OA\Property(property="data", ref="#/components/schemas/Article")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article non trouvé",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Article non trouvé")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'type_article' => 'required|string|max:255',
        ]);

        $article->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Article mis à jour avec succès.',
            'data' => $article
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/articles/{id}",
     *     tags={"Articles"},
     *     summary="Supprimer un article",
     *     description="Supprime un article existant.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article supprimé avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Article supprimé avec succès.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article non trouvé",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Article non trouvé")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article supprimé avec succès.'
        ]);
    }
}
