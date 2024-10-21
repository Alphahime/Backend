<?php


namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use App\Mail\CoachAcceptedMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @OA\Tag(
 *     name="Coaches",
 *     description="API Endpoints pour les coachs"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Coach",
 *     type="object",
 *     title="Coach",
 *     required={"user_id", "profil_verifie"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID du coach"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="ID de l'utilisateur associé"
 *     ),
 *     @OA\Property(
 *         property="profil_verifie",
 *         type="boolean",
 *         description="Statut de vérification du profil"
 *     ),
 *     @OA\Property(
 *         property="experience",
 *         type="string",
 *         description="Détails de l'expérience du coach"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Description du coach"
 *     ),
 *     @OA\Property(
 *         property="lieu",
 *         type="string",
 *         description="Lieu du coach"
 *     ),
 *     @OA\Property(
 *         property="services",
 *         type="object",
 *         description="Services offerts par le coach",
 *         example={"coaching": "Développement personnel", "mentorat": "Entrepreneuriat"}
 *     ),
 *     @OA\Property(
 *         property="galerie_photos",
 *         type="array",
 *         @OA\Items(type="string", format="url"),
 *         description="Galerie de photos du coach"
 *     ),
 *     @OA\Property(
 *         property="diplomes",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="Diplômes ou certifications du coach"
 *     ),
 *     @OA\Property(
 *         property="disponibilites",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="Disponibilités du coach"
 *     )
 * )
 */
class CoachController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/coaches",
     *     operationId="storeCoach",
     *     tags={"Coaches"},
     *     summary="Créer un nouveau coach",
     *     description="Créer un nouveau coach avec les informations fournies",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCoachRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Coach créé avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Coach")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides"
     *     )
     * )
     */
    public function store(StoreCoachRequest $request)
    {
        $validatedData = $request->validated();
    
        // Création d'un nouveau coach
        $coach = Coach::create($validatedData);
    
        return response()->json($coach, 201);
    }
    
    

    /**
     * @OA\Get(
     *     path="/api/coaches",
     *     operationId="getAllCoaches",
     *     tags={"Coaches"},
     *     summary="Obtenir tous les coachs",
     *     description="Retourne une liste de tous les coachs",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des coachs",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Coach"))
     *     )
     * )
     */
    public function index()
    {
        try {
            // Récupérer tous les coachs
            $coaches = Coach::all();
            return response()->json($coaches, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la récupération des coachs.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/coaches/{id}",
     *     operationId="getCoachById",
     *     tags={"Coaches"},
     *     summary="Obtenir les détails d'un coach",
     *     description="Retourne les détails d'un coach spécifique",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID du coach"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du coach",
     *         @OA\JsonContent(ref="#/components/schemas/Coach")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Coach non trouvé"
     *     )
     * )
     */
    public function show($id)
    {
        // Récupérer les détails du coach avec les informations de l'utilisateur
        $coach = Coach::with('user')->find($id);

        if (!$coach) {
            return response()->json(['message' => 'Coach not found'], 404);
        }

        return response()->json([
            'coach' => $coach,
            'user' => $coach->user // Cela renverra l'utilisateur lié au coach
        ]);
    }
    /**
     * @OA\Put(
     *     path="/api/coaches/{id}",
     *     operationId="updateCoach",
     *     tags={"Coaches"},
     *     summary="Mettre à jour un coach",
     *     description="Met à jour les informations d'un coach spécifique",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID du coach"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCoachRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Coach mis à jour avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Coach")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Données invalides"
     *     )
     * )
     */
    public function update(UpdateCoachRequest $request, $id)
    {
        try {
            // Récupérer le coach à mettre à jour
            $coach = Coach::findOrFail($id);
            // Mettre à jour les données validées
            $coach->update($request->validated());
    
            return response()->json($coach, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Coach non trouvé.'], 404);
        }
    }
    

    /**
     * @OA\Delete(
     *     path="/api/coaches/{id}",
     *     operationId="deleteCoach",
     *     tags={"Coaches"},
     *     summary="Supprimer un coach",
     *     description="Supprimer un coach existant",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID du coach"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Coach supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Coach non trouvé"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            // Récupérer et supprimer le coach
            $coach = Coach::findOrFail($id);
            $coach->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Coach non trouvé.',
                'details' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la suppression du coach.',
                'details' => $e->getMessage()
            ], 500);
        }
    }


   

    public function acceptCoach($id)
    {
        $coach = Coach::find($id);
        
        if (!$coach) {
            return response()->json(['message' => 'Coach non trouvé'], 404);
        }
        
        $user = User::find($coach->user_id);
        $temporaryPassword = Str::random(10); // Génération du mot de passe temporaire
    
        // Créer l'utilisateur s'il n'existe pas
        if (!$user) {
            $user = User::create([
                'nom' => $coach->name,
                'email' => $coach->email,
                'mot_de_passe' => Hash::make($temporaryPassword), // Utilisation du mot de passe temporaire
            ]);
        } else {
            // Si l'utilisateur existe, mettre à jour son mot de passe avec le mot de passe temporaire
            $user->mot_de_passe = Hash::make($temporaryPassword);
            $user->save();
        }
        
        $coach->profil_verifie = true;
        $coach->save();
        
        try {
            Mail::to($user->email)->send(new CoachAcceptedMail($user, $temporaryPassword));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage()], 500);
        }
        
        return response()->json([
            'message' => 'Coach accepté et accès générés avec succès',
            'temporaryPassword' => $temporaryPassword 
        ]);
    }
    
}
