<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Affiche la liste des messages de l'utilisateur authentifié
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
    
    // Crée un nouveau message associé à l'utilisateur authentifié
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

    // Affiche un message spécifique si l'utilisateur est autorisé
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

    // Met à jour un message spécifique si l'utilisateur est autorisé
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

    // Supprime un message spécifique si l'utilisateur est autorisé
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
