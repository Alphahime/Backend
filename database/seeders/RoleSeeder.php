<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les rôles
        $roles = [
            'super admin',
            'coach',
            'client'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Assigner des permissions à chaque rôle
        $superAdmin = Role::findByName('super admin');
        $coach = Role::findByName('coach');
        $client = Role::findByName('client');

        // Assigner toutes les permissions au super admin
        $superAdmin->givePermissionTo(Permission::all());

        // Permissions spécifiques pour le coach
        $coachPermissions = [
            'view users',
            'edit users',
            'view roles',
            'view permissions',
        ];
        $coach->givePermissionTo($coachPermissions);

        // Permissions spécifiques pour le client
        $clientPermissions = [
            'view users',
        ];
        $client->givePermissionTo($clientPermissions);
    }
}

