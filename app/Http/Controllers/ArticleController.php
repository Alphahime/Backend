<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Affiche la liste des articles avec les informations sur l'utilisateur
    public function index()
    {
        // Charge les articles avec l'utilisateur associé
        $articles = Article::with('user')->get(); 
    
        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    // Enregistre un nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'type_article' => 'required|string|max:255',
        ]);
    
        // Crée l'article sans lier à un utilisateur pour le moment
      

        $article = Article::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'type_article' => $request->type_article,
            'user_id' => Auth::id(), // Utilisez l'ID de l'utilisateur authentifié
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Article créé avec succès.',
            'data' => $article
        ]);
    }
    

    // Affiche un article spécifique avec l'utilisateur associé
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);
    
        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    // Met à jour un article
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

    // Supprime un article
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

