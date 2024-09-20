<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\SuiviSeanceController;
use App\Http\Controllers\DomaineSportifController;
use App\Http\Controllers\PlanNutritionnelController;
use App\Http\Controllers\SeanceEntrainementController;
use App\Http\Controllers\ProgrammeEntrainementController;
use App\Http\Controllers\CoachingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentaireController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Liste des programme-entrainements
Route::get('/programme-entrainements', [ProgrammeEntrainementController::class, 'index']);

// Créer un nouveau programme-entrainement
Route::post('programme-entrainements', [ProgrammeEntrainementController::class, 'store']);

// Afficher un programme-entrainement spécifique
Route::get('programme-entrainements/{programmeEntrainement}', [ProgrammeEntrainementController::class, 'show']);

// Mettre à jour un programme-entrainement spécifique
Route::put('programme-entrainements/{programmeEntrainement}', [ProgrammeEntrainementController::class, 'update']);

// Supprimer un programme-entrainement spécifique
Route::delete('programme-entrainements/{programmeEntrainement}', [ProgrammeEntrainementController::class, 'destroy']);




Route::get('/domaine-sportifs', [DomaineSportifController::class, 'index']);
Route::post('/domaine-sportifs', [DomaineSportifController::class, 'store']);
Route::get('/domaine-sportifs/{domaineSportif}', [DomaineSportifController::class, 'show']);
Route::put('/domaine-sportifs/{domaineSportif}', [DomaineSportifController::class, 'update']);
Route::delete('/domaine-sportifs/{domaineSportif}', [DomaineSportifController::class, 'destroy']);

// Liste des ressources
Route::get('ressources', [RessourceController::class, 'index']);

// Créer une nouvelle ressource
Route::post('ressources', [RessourceController::class, 'store']);

// Afficher une ressource spécifique
Route::get('ressources/{ressource}', [RessourceController::class, 'show']);

// Mettre à jour une ressource spécifique
Route::put('ressources/{ressource}', [RessourceController::class, 'update']);

// Supprimer une ressource spécifique
Route::delete('ressources/{ressource}', [RessourceController::class, 'destroy']);



// Liste des seance-entrainements
Route::get('seance-entrainements', [SeanceEntrainementController::class, 'index']);

// Créer une nouvelle seance-entrainement
Route::post('seance-entrainements', [SeanceEntrainementController::class, 'store']);

// Afficher une seance-entrainement spécifique
Route::get('seance-entrainements/{seanceEntrainement}', [SeanceEntrainementController::class, 'show']);

// Mettre à jour une seance-entrainement spécifique
Route::put('seance-entrainements/{seanceEntrainement}', [SeanceEntrainementController::class, 'update']);

// Supprimer une seance-entrainement spécifique
Route::delete('seance-entrainements/{seanceEntrainement}', [SeanceEntrainementController::class, 'destroy']);



// Liste des suivi-seances
Route::get('suivi-seances', [SuiviSeanceController::class, 'index']);

// Créer un nouveau suivi-seance
Route::post('suivi-seances', [SuiviSeanceController::class, 'store']);

// Afficher un suivi-seance spécifique
Route::get('suivi-seances/{suiviSeance}', [SuiviSeanceController::class, 'show']);

// Mettre à jour un suivi-seance spécifique
Route::put('suivi-seances/{suiviSeance}', [SuiviSeanceController::class, 'update']);

// Supprimer un suivi-seance spécifique
Route::delete('suivi-seances/{suiviSeance}', [SuiviSeanceController::class, 'destroy']);

// Liste des plans-nutritionnels
Route::get('plans-nutritionnels', [PlanNutritionnelController::class, 'index']);

// Créer un nouveau plan-nutritionnel
Route::post('plans-nutritionnels', [PlanNutritionnelController::class, 'store']);

// Afficher un plan-nutritionnel spécifique
Route::get('plans-nutritionnels/{planNutritionnel}', [PlanNutritionnelController::class, 'show']);

// Mettre à jour un plan-nutritionnel spécifique
Route::put('plans-nutritionnels/{planNutritionnel}', [PlanNutritionnelController::class, 'update']);

// Supprimer un plan-nutritionnel spécifique
Route::delete('plans-nutritionnels/{planNutritionnel}', [PlanNutritionnelController::class, 'destroy']);



// Liste des articles
Route::get('articles', [ArticleController::class, 'index']);

// Créer un nouvel article
Route::post('articles', [ArticleController::class, 'store']);

// Afficher un article spécifique
Route::get('articles/{article}', [ArticleController::class, 'show']);

// Mettre à jour un article spécifique
Route::put('articles/{article}', [ArticleController::class, 'update']);

// Supprimer un article spécifique
Route::delete('articles/{article}', [ArticleController::class, 'destroy']);




// Liste des catégories
Route::get('categories', [CategorieController::class, 'index']);

// Créer une nouvelle catégorie
Route::post('categories', [CategorieController::class, 'store']);

// Afficher une catégorie spécifique
Route::get('categories/{categorie}', [CategorieController::class, 'show']);

// Mettre à jour une catégorie spécifique
Route::put('categories/{categorie}', [CategorieController::class, 'update']);

// Supprimer une catégorie spécifique
Route::delete('categories/{categorie}', [CategorieController::class, 'destroy']);


Route::get('/coachings', [CoachingController::class, 'index']);          // Récupère tous les coachings
Route::post('/coachings', [CoachingController::class, 'store']);         // Crée un nouveau coaching
Route::get('/coachings/{id}', [CoachingController::class, 'show']);      // Affiche un coaching spécifique
Route::put('/coachings/{id}', [CoachingController::class, 'update']);    // Met à jour un coaching
Route::delete('/coachings/{id}', [CoachingController::class, 'destroy']); // Supprime un coaching

Route::get('messages', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);
Route::get('messages/{message}', [MessageController::class, 'show']);
Route::put('messages/{message}', [MessageController::class, 'update']);
Route::delete('messages/{message}', [MessageController::class, 'destroy']);


Route::get('/commentaires', [CommentaireController::class, 'index']);
    Route::post('/commentaires', [CommentaireController::class, 'store']);
    Route::get('/commentaires/{commentaire}', [CommentaireController::class, 'show']);
    Route::put('/commentaires/{commentaire}', [CommentaireController::class, 'update']);
    Route::delete('/commentaires/{commentaire}', [CommentaireController::class, 'destroy']);