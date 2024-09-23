<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

/**
 * @OA\Tag(name="Permissions", description="Opérations liées aux permissions")
 */
class PermissionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/permissions",
     *     tags={"Permissions"},
     *     summary="Lister toutes les permissions",
     *     @OA\Response(response="200", description="Liste des permissions")
     * )
     */
    public function index()
    {
        return response()->json(Permission::all());
    }

    /**
     * @OA\Post(
     *     path="/api/permissions",
     *     tags={"Permissions"},
     *     summary="Créer une nouvelle permission",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="edit articles")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Permission créée avec succès"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|unique:permissions']);
        $permission = Permission::create($validated);
        return response()->json($permission, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/permissions/{id}",
     *     tags={"Permissions"},
     *     summary="Afficher une permission spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la permission", @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Détails de la permission"),
     *     @OA\Response(response="404", description="Permission non trouvée")
     * )
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }

    /**
     * @OA\Put(
     *     path="/api/permissions/{id}",
     *     tags={"Permissions"},
     *     summary="Mettre à jour une permission spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la permission", @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="update articles")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Permission mise à jour avec succès"),
     *     @OA\Response(response="404", description="Permission non trouvée"),
     *     @OA\Response(response="422", description="Données invalides")
     * )
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $validated = $request->validate(['name' => 'required|string|unique:permissions,name,' . $permission->id]);
        $permission->update($validated);
        return response()->json($permission);
    }

    /**
     * @OA\Delete(
     *     path="/api/permissions/{id}",
     *     tags={"Permissions"},
     *     summary="Supprimer une permission spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la permission", @OA\Schema(type="integer")),
     *     @OA\Response(response="204", description="Permission supprimée avec succès"),
     *     @OA\Response(response="404", description="Permission non trouvée")
     * )
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json(null, 204);
    }
}
