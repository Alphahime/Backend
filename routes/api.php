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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ReservationController;


// Routes accessibles sans authentification
Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

// Routes publiques 

Route::get('/users', [UserController::class, 'index']);
Route::get('/programme-entrainements', [ProgrammeEntrainementController::class, 'index']);
Route::get('/domaine-sportifs', [DomaineSportifController::class, 'index']);
Route::get('ressources', [RessourceController::class, 'index']);
Route::get('seance-entrainements', [SeanceEntrainementController::class, 'index']);
Route::get('plans-nutritionnels', [PlanNutritionnelController::class, 'index']);
Route::get('articles', [ArticleController::class, 'index']);
Route::get('categories', [CategorieController::class, 'index']);
Route::get('/commentaires', [CommentaireController::class, 'index']);


// Routes protégées par authentification
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::get('user', [JWTAuthController::class, 'getUser']);

    // Routes Messages
    Route::get('messages', [MessageController::class, 'index']);
    Route::post('messages', [MessageController::class, 'store']);
    Route::get('messages/{message}', [MessageController::class, 'show']);
    Route::put('messages/{message}', [MessageController::class, 'update']);
    Route::delete('messages/{message}', [MessageController::class, 'destroy']);

   
    // Routes Catégories
    Route::post('categories', [CategorieController::class, 'store']);
    Route::get('categories/{categorie}', [CategorieController::class, 'show']);
    Route::put('categories/{categorie}', [CategorieController::class, 'update']);
    Route::delete('categories/{categorie}', [CategorieController::class, 'destroy']);

  
   
   
    // Routes Seance Entrainements
    Route::post('seance-entrainements', [SeanceEntrainementController::class, 'store']);
    Route::get('seance-entrainements/{seanceEntrainement}', [SeanceEntrainementController::class, 'show']);
    Route::put('seance-entrainements/{seanceEntrainement}', [SeanceEntrainementController::class, 'update']);
    Route::delete('seance-entrainements/{seanceEntrainement}', [SeanceEntrainementController::class, 'destroy']);

    // Routes Domaine Sportifs
    Route::post('/domaine-sportifs', [DomaineSportifController::class, 'store']);
    Route::get('/domaine-sportifs/{domaineSportif}', [DomaineSportifController::class, 'show']);
    Route::put('/domaine-sportifs/{domaineSportif}', [DomaineSportifController::class, 'update']);
    Route::delete('/domaine-sportifs/{domaineSportif}', [DomaineSportifController::class, 'destroy']);

    // Routes Ressources
    Route::post('ressources', [RessourceController::class, 'store']);
    Route::get('ressources/{ressource}', [RessourceController::class, 'show']);
    Route::put('ressources/{ressource}', [RessourceController::class, 'update']);
    Route::delete('ressources/{ressource}', [RessourceController::class, 'destroy']);

    
  
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);
    
 
 
});
Route::get('/coaches', [CoachController::class, 'index']);

// Route pour ajouter un plan nutritionnel
Route::post('plans-nutritionnels', [PlanNutritionnelController::class, 'store']);
// Routes pour récupérer, mettre à jour et supprimer des plans nutritionnels
Route::get('plans-nutritionnels', [PlanNutritionnelController::class, 'index']);
Route::get('plans-nutritionnels/{planNutritionnel}', [PlanNutritionnelController::class, 'show']);
Route::put('plans-nutritionnels/{planNutritionnel}', [PlanNutritionnelController::class, 'update']);
Route::delete('plans-nutritionnels/{planNutritionnel}', [PlanNutritionnelController::class, 'destroy']);
 // Routes Articles
 Route::post('articles', [ArticleController::class, 'store']);
 Route::get('articles/{article}', [ArticleController::class, 'show']);
 Route::put('articles/{article}', [ArticleController::class, 'update']);
 Route::delete('articles/{article}', [ArticleController::class, 'destroy']);
// Routes Commentaires
Route::post('/commentaires', [CommentaireController::class, 'store']);
Route::get('/commentaires/{commentaire}', [CommentaireController::class, 'show']);
Route::put('/commentaires/{commentaire}', [CommentaireController::class, 'update']);
Route::delete('/commentaires/{commentaire}', [CommentaireController::class, 'destroy']);
 // Routes Programme Entrainements
 Route::post('programme-entrainements', [ProgrammeEntrainementController::class, 'store']);
 Route::get('programme-entrainements/{programmeEntrainement}', [ProgrammeEntrainementController::class, 'show']);
 Route::put('programme-entrainements/{programmeEntrainement}', [ProgrammeEntrainementController::class, 'update']);
 Route::delete('programme-entrainements/{programmeEntrainement}', [ProgrammeEntrainementController::class, 'destroy']);


 Route::get('/suivis', [SuiviSeanceController::class, 'index']);
 Route::post('/suivis', [SuiviSeanceController::class, 'store']);
 Route::get('/suivis/{id}', [SuiviSeanceController::class, 'show']);
 Route::put('/suivis/{id}', [SuiviSeanceController::class, 'update']);
 Route::delete('/suivis/{id}', [SuiviSeanceController::class, 'destroy']);

  // Routes Coachings
  Route::get('/coachings', [CoachingController::class, 'index']);
  Route::post('/coachings', [CoachingController::class, 'store']);
  Route::get('/coachings/{id}', [CoachingController::class, 'show']);
  Route::put('/coachings/{id}', [CoachingController::class, 'update']);
  Route::delete('/coachings/{id}', [CoachingController::class, 'destroy']);

   
  Route::post('/coaches', [CoachController::class, 'store']);
  Route::get('/coaches/{id}', [CoachController::class, 'show']);
  Route::put('/coaches/{id}', [CoachController::class, 'update']);
  Route::delete('/coaches/{id}', [CoachController::class, 'destroy']);
  
    // Routes pour rôles et permissions
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    
    Route::post('/accept-coach/{id}', [CoachController::class, 'acceptCoach']);
    Route::put('/coaches/accept-coach/{id}', [CoachController::class, 'acceptCoach']);

    Route::get('/reservations', [ReservationController::class, 'index']);
    