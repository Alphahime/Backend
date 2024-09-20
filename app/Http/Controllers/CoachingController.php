<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use Illuminate\Http\Request;

class CoachingController extends Controller
{
    public function index()
    {
        $coachings = Coaching::with('user')->get(); 
        return response()->json([
            'success' => true,
            'data' => $coachings
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id', 
        ]);

        $coaching = Coaching::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $coaching
        ]);
    }

    public function show($id)
    {
        $coaching = Coaching::with('user')->find($id); 

        if (!$coaching) {
            return response()->json(['success' => false, 'message' => 'Coaching non trouvé.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $coaching
        ]);
    }

    public function update(Request $request, $id)
    {
        $coaching = Coaching::find($id);

        if (!$coaching) {
            return response()->json(['success' => false, 'message' => 'Coaching non trouvé.'], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id', 
        ]);

        $coaching->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $coaching
        ]);
    }

    public function destroy($id)
    {
        $coaching = Coaching::find($id);

        if (!$coaching) {
            return response()->json(['success' => false, 'message' => 'Coaching non trouvé.'], 404);
        }

        $coaching->delete();

        return response()->json(['success' => true, 'message' => 'Coaching supprimé avec succès.']);
    }
}
