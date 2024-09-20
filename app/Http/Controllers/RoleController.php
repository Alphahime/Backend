<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    // Afficher la liste des rôles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Afficher le formulaire de création d'un rôle
    public function create()
    {
        return view('roles.create');
    }

    // Stocker un nouveau rôle
    public function store(StoreRoleRequest $request)
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Afficher le formulaire d'édition d'un rôle
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Mettre à jour un rôle
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Supprimer un rôle
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
