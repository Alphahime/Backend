<?php

namespace App\Http\Controllers;

use App\Models\DomaineSportif;
use App\Http\Requests\StoreDomaineSportifRequest;
use App\Http\Requests\UpdateDomaineSportifRequest;
use Illuminate\Http\JsonResponse;

class DomaineSportifController extends Controller
{
    public function index(): JsonResponse
    {
        $domaines = DomaineSportif::with('categories')->get(); // Inclure les catégories
        return response()->json($domaines);
    }

    public function store(StoreDomaineSportifRequest $request): JsonResponse
    {
        $domaine = DomaineSportif::create($request->validated());
        // Attacher des catégories après la création du domaine sportif
        if ($request->has('category_ids')) {
            $domaine->categories()->sync($request->category_ids);
        }
        return response()->json($domaine, 201);
    }

    public function show(DomaineSportif $domaineSportif): JsonResponse
    {
        $domaineSportif->load('categories'); // Inclure les catégories
        return response()->json($domaineSportif);
    }

    public function update(UpdateDomaineSportifRequest $request, DomaineSportif $domaineSportif): JsonResponse
    {
        $domaineSportif->update($request->validated());
        // Mettre à jour les catégories
        if ($request->has('category_ids')) {
            $domaineSportif->categories()->sync($request->category_ids);
        }
        return response()->json($domaineSportif);
    }

    public function destroy(DomaineSportif $domaineSportif): JsonResponse
    {
        $domaineSportif->delete();
        return response()->json(null, 204);
    }
}
