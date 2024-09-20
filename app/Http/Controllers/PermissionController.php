<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    // Afficher la liste des permissions
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    // Afficher le formulaire de création d'une permission
    public function create()
    {
        return view('permissions.create');
    }

    // Stocker une nouvelle permission
    public function store(StorePermissionRequest $request)
    {
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    // Afficher le formulaire d'édition d'une permission
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    // Mettre à jour une permission
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    // Supprimer une permission
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
