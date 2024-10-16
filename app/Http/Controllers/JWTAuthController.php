<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


/**
 * @OA\Tag(name="Auth", description="Opérations liées à l'authentification JWT")
 * 
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nom", type="string", example="John"),
 *     @OA\Property(property="prenom", type="string", example="Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *     @OA\Property(property="telephone", type="string", example="123456789"),
 *     @OA\Property(property="localisation", type="string", example="Dakar, Sénégal"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

class JWTAuthController extends Controller
{

 /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     summary="Enregistrer un nouvel utilisateur",
     *     description="Créer un nouvel utilisateur dans le système",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom","prenom","email","mot_de_passe","telephone","localisation"},
     *             @OA\Property(property="nom", type="string", example="John"),
     *             @OA\Property(property="prenom", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="mot_de_passe", type="string", format="password", example="password123"),
     *             @OA\Property(property="mot_de_passe_confirmation", type="string", format="password", example="password123"),
     *             @OA\Property(property="telephone", type="string", example="123456789"),
     *             @OA\Property(property="localisation", type="string", example="Dakar, Sénégal")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Utilisateur créé avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User")
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

     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'nom' => 'required|string|max:255',
             'prenom' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'mot_de_passe' => 'required|string|min:6|confirmed',
             'telephone' => 'required|string',
             'localisation' => 'required|string',
             'role' => 'required|string' // Vérifier le rôle
         ]);
     
         if ($validator->fails()) {
             return response()->json($validator->errors()->toJson(), 400);
         }
     
         $user = User::create([
             'nom' => $request->get('nom'),
             'prenom' => $request->get('prenom'),
             'email' => $request->get('email'),
             'mot_de_passe' => Hash::make($request->get('mot_de_passe')),
             'telephone' => $request->get('telephone'),
             'localisation' => $request->get('localisation'),
         ]);
     
         // Assigner le rôle à l'utilisateur nouvellement créé
         $user->assignRole($request->get('role')); // Cela devrait fonctionner maintenant
     
         return response()->json(compact('user'), 201);
     }
     
     public function login(Request $request)
     {
         $credentials = $request->only('email', 'mot_de_passe');
     
         // Vérification manuelle du mot de passe
         $user = User::where('email', $credentials['email'])->first();
     
         if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
             // Générer un token JWT
             $token = JWTAuth::fromUser($user);
             
             // Récupérer le rôle
             $role = $user->getRoleNames()->first(); // Assumes you use Spatie\Permission
     
             return response()->json([
                 'token' => $token,
                 'user' => $user,
                 'role' => $role
             ]);
         }
     
         return response()->json(['error' => 'Identifiants invalides'], 400);
     }
     
    
    public function getUser(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json(compact('user'), 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }

   
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}


