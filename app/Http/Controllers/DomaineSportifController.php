<?php

namespace App\Http\Controllers;

use App\Models\DomaineSportif;
use App\Http\Requests\StoreDomaineSportifRequest;
use App\Http\Requests\UpdateDomaineSportifRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(name="Domaines Sportifs", description="Opérations liées aux domaines sportifs")
 *
 * @OA\Schema(
 *     schema="DomaineSportif",
 *     type="object",
 *     required={"name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Football"),
 *     @OA\Property(property="categories", type="array", @OA\Items(ref="#/components/schemas/Category"))
 * )
 *
 * @OA\Schema(
 *     schema="Category",
 *     type="object",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Catégorie de Football")
 * )
 *
 * @OA\Schema(
 *     schema="StoreDomaineSportifRequest",
 *     type="object",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", example="Football"),
 *     @OA\Property(property="category_ids", type="array", @OA\Items(type="integer"), example={1,2})
 * )
 *
 * @OA\Schema(
 *     schema="UpdateDomaineSportifRequest",
 *     type="object",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", example="Football Modifié"),
 *     @OA\Property(property="category_ids", type="array", @OA\Items(type="integer"), example={1,3})
 * )
 */
class DomaineSportifController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/domaines-sportifs",
     *     tags={"Domaines Sportifs"},
     *     summary="Lister tous les domaines sportifs",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des domaines sportifs récupérée avec succès.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/DomaineSportif"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $domaines = DomaineSportif::with('categories')->get();
        return response()->json($domaines);
    }

    /**
     * @OA\Post(
     *     path="/api/domaines-sportifs",
     *     tags={"Domaines Sportifs"},
     *     summary="Créer un nouveau domaine sportif",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreDomaineSportifRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Domaine sportif créé avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/DomaineSportif")
     *     )
     * )
     */
    public function store(StoreDomaineSportifRequest $request): JsonResponse
    {
        $domaine = DomaineSportif::create($request->validated());
        if ($request->has('category_ids')) {
            $domaine->categories()->sync($request->category_ids);
        }
        return response()->json($domaine, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/domaines-sportifs/{id}",
     *     tags={"Domaines Sportifs"},
     *     summary="Afficher un domaine sportif spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Domaine sportif récupéré avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/DomaineSportif")
     *     ),
     *     @OA\Response(response=404, description="Domaine sportif non trouvé.")
     * )
     */
    public function show(DomaineSportif $domaineSportif): JsonResponse
    {
        $domaineSportif->load('categories');
        return response()->json($domaineSportif);
    }

    /**
     * @OA\Put(
     *     path="/api/domaines-sportifs/{id}",
     *     tags={"Domaines Sportifs"},
     *     summary="Mettre à jour un domaine sportif spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateDomaineSportifRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Domaine sportif mis à jour avec succès.",
     *         @OA\JsonContent(ref="#/components/schemas/DomaineSportif")
     *     ),
     *     @OA\Response(response=404, description="Domaine sportif non trouvé.")
     * )
     */
    public function update(UpdateDomaineSportifRequest $request, DomaineSportif $domaineSportif): JsonResponse
    {
        $domaineSportif->update($request->validated());
        if ($request->has('category_ids')) {
            $domaineSportif->categories()->sync($request->category_ids);
        }
        return response()->json($domaineSportif);
    }

    /**
     * @OA\Delete(
     *     path="/api/domaines-sportifs/{id}",
     *     tags={"Domaines Sportifs"},
     *     summary="Supprimer un domaine sportif spécifique",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=204,
     *         description="Domaine sportif supprimé avec succès."
     *     ),
     *     @OA\Response(response=404, description="Domaine sportif non trouvé.")
     * )
     */
    public function destroy(DomaineSportif $domaineSportif): JsonResponse
    {
        $domaineSportif->delete();
        return response()->json(null, 204);
    }
}
