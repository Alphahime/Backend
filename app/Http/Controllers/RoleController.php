<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

/**
 * @OA\Tag(name="Roles", description="Opérations liées aux rôles")
 */
class RoleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/roles",
     *     tags={"Roles"},
     *     summary="Lister tous les rôles",
     *     @OA\Response(response="200", description="Liste des rôles")
     * )
     */
    public function index()
    {
        return response()->json(Role::all());
    }

    /**
     * @OA\Post(
     *     path="/api/roles",
     *     tags={"Roles"},
     *     summary="Créer un nouveau rôle",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Admin")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Rôle créé avec succès"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|unique:roles']);
        $role = Role::create($validated);
        return response()->json($role, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/roles/{id}",
     *     tags={"Roles"},
     *     summary="Afficher un rôle spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du rôle", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Détails du rôle"),
     *     @OA\Response(response="404", description="Rôle non trouvé")
     * )
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    /**
     * @OA\Put(
     *     path="/api/roles/{id}",
     *     tags={"Roles"},
     *     summary="Mettre à jour un rôle spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du rôle", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Super Admin")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Rôle mis à jour avec succès"),
     *     @OA\Response(response="404", description="Rôle non trouvé"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $validated = $request->validate(['name' => 'required|string|unique:roles,name,' . $role->id]);
        $role->update($validated);
        return response()->json($role);
    }

    /**
     * @OA\Delete(
     *     path="/api/roles/{id}",
     *     tags={"Roles"},
     *     summary="Supprimer un rôle spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du rôle", @OA\Schema(type="integer")),
     *     @OA\Response(response="204", description="Rôle supprimé avec succès"),
     *     @OA\Response(response="404", description="Rôle non trouvé")
     * )
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(null, 204);
    }
}
