<?php

namespace App\Http\Controllers;

use App\Models\SuiviSeance;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSuiviSeanceRequest;
use App\Http\Requests\UpdateSuiviSeanceRequest;

class SuiviSeanceController extends Controller
{
    public function index()
    {
        $suivis = SuiviSeance::all();
        return view('suivis.index', compact('suivis'));
    }

    public function create()
    {
        return view('suivis.create');
    }

    public function store(StoreSuiviSeanceRequest $request)
    {
        SuiviSeance::create($request->validated());
        return redirect()->route('suivis.index')->with('success', 'Suivi de Séance créé avec succès.');
    }

    public function edit(SuiviSeance $suivi)
    {
        return view('suivis.edit', compact('suivi'));
    }

    public function update(UpdateSuiviSeanceRequest $request, SuiviSeance $suivi)
    {
        $suivi->update($request->validated());
        return redirect()->route('suivis.index')->with('success', 'Suivi de Séance mis à jour avec succès.');
    }

    public function destroy(SuiviSeance $suivi)
    {
        $suivi->delete();
        return redirect()->route('suivis.index')->with('success', 'Suivi de Séance supprimé avec succès.');
    }
}
