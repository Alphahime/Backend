<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgrammeEntrainementRequest;
use App\Http\Requests\UpdateProgrammeEntrainementRequest;
use App\Models\ProgrammeEntrainement;
use Illuminate\Http\JsonResponse;

class ProgrammeEntrainementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $programmes = ProgrammeEntrainement::all();
        return response()->json($programmes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgrammeEntrainementRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $programme = ProgrammeEntrainement::create($validated);
        return response()->json($programme, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgrammeEntrainement $programmeEntrainement): JsonResponse
    {
        return response()->json($programmeEntrainement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgrammeEntrainementRequest $request, ProgrammeEntrainement $programmeEntrainement): JsonResponse
{
    $validated = $request->validated();
    $programmeEntrainement->update($validated);
    return response()->json($programmeEntrainement);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $programmeEntrainement = ProgrammeEntrainement::find($id);
    
        if (!$programmeEntrainement) {
            return response()->json(['message' => 'Programme non trouvé.'], 404);
        }
    
        $programmeEntrainement->delete();
        return response()->json(['message' => 'Programme d\'entrainement supprimé avec succès.'], 200);
    }
    
}
