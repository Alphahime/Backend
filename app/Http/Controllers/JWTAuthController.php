<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mot_de_passe' => 'required|string|min:6|confirmed',
            'telephone' => 'required|string',
            'localisation' => 'required|string',
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
    
        return response()->json(compact('user'), 201);
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'mot_de_passe');
    
        if (!$token = JWTAuth::attempt(['email' => $credentials['email'], 'password' => $credentials['mot_de_passe']])) {
            return response()->json(['error' => 'Invalid credentials'], 400);
        }
    
        return response()->json(compact('token'));
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


