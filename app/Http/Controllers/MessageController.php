<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(name="Messages", description="Opérations liées aux messages")
 */
class MessageController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/messages",
     *     tags={"Messages"},
     *     summary="Lister tous les messages de l'utilisateur authentifié",
     *     @OA\Response(response="200", description="Liste des messages"),
     *     @OA\Response(response="401", description="Utilisateur non authentifié")
     * )
     */
    public function index()
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié.'
            ], 401);
        }
    
        $messages = Message::where('user_id', $user->id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $messages
        ]);
    }
    
    /**
     * @OA\Post(
     *     path="/api/messages",
     *     tags={"Messages"},
     *     summary="Créer un nouveau message",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="content", type="string", example="Contenu du message"),
     *             @OA\Property(property="title", type="string", example="Titre du message")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Message créé avec succès"),
     *     @OA\Response(response="401", description="Utilisateur non authentifié"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function store(StoreMessageRequest $request)
    {
        $user = Auth::user();
        $message = Message::create(array_merge($request->validated(), ['user_id' => $user->id]));

        return response()->json([
            'success' => true,
            'data' => $message,
            'message' => 'Message créé avec succès.'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/messages/{id}",
     *     tags={"Messages"},
     *     summary="Afficher un message spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du message", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Détails du message"),
     *     @OA\Response(response="403", description="Accès non autorisé"),
     *     @OA\Response(response="404", description="Message non trouvé")
     * )
     */
    public function show(Message $message)
    {
        $user = Auth::user();

        if ($message->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas accès à ce message.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $message
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/messages/{id}",
     *     tags={"Messages"},
     *     summary="Mettre à jour un message spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du message", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="content", type="string", example="Contenu mis à jour du message"),
     *             @OA\Property(property="title", type="string", example="Titre mis à jour du message")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Message mis à jour avec succès"),
     *     @OA\Response(response="403", description="Accès non autorisé"),
     *     @OA\Response(response="404", description="Message non trouvé"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $user = Auth::user();

        if ($message->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas accès à ce message.'
            ], 403);
        }

        $message->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $message,
            'message' => 'Message mis à jour avec succès.'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/messages/{id}",
     *     tags={"Messages"},
     *     summary="Supprimer un message spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du message", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Message supprimé avec succès"),
     *     @OA\Response(response="403", description="Accès non autorisé"),
     *     @OA\Response(response="404", description="Message non trouvé")
     * )
     */
    public function destroy(Message $message)
    {
        $user = Auth::user();

        if ($message->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas accès à ce message.'
            ], 403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Message supprimé avec succès.'
        ]);
    }
}
