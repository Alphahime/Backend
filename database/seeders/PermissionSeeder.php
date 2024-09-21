<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des permissions
        $permissions = [
            'create users',
            'edit users',
            'delete users',
            'view users',
            'create roles',
            'edit roles',
            'delete roles',
            'view roles',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'view permissions',
        ];

        // Créer chaque permission
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
