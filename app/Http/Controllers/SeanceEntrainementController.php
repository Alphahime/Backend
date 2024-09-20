<?php

namespace App\Http\Controllers;

use App\Models\SeanceEntrainement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSeanceEntrainementRequest;
use App\Http\Requests\UpdateSeanceEntrainementRequest;

class SeanceEntrainementController extends Controller
{
    public function index()
    {
        $seances = SeanceEntrainement::all();
        return view('seances.index', compact('seances'));
    }

    public function create()
    {
        return view('seances.create');
    }

    public function store(StoreSeanceEntrainementRequest $request)
    {
        SeanceEntrainement::create($request->validated());
        return redirect()->route('seances.index')->with('success', 'Séance d\'Entrainement créée avec succès.');
    }

    public function edit(SeanceEntrainement $seance)
    {
        return view('seances.edit', compact('seance'));
    }

    public function update(UpdateSeanceEntrainementRequest $request, SeanceEntrainement $seance)
    {
        $seance->update($request->validated());
        return redirect()->route('seances.index')->with('success', 'Séance d\'Entrainement mise à jour avec succès.');
    }

    public function destroy(SeanceEntrainement $seance)
    {
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance d\'Entrainement supprimée avec succès.');
    }
}
