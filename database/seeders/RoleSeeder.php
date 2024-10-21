<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les rôles s'ils n'existent pas
        $roles = [
            'super admin',
            'coach',
            'client'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Créer les permissions s'ils n'existent pas
        $permissions = [
            'view users',
            'edit users',
            'view roles',
            'view permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
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

        // Créer ou mettre à jour l'utilisateur admin
        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'nom' => 'Admin',
            'prenom' => 'Super',
            'mot_de_passe' => bcrypt('adminpassword'),
            'telephone' => '123456789',
            'localisation' => 'Dakar, Sénégal',
        ]);

        // Assigner le rôle super admin à l'admin
        $adminUser->assignRole('super admin');
    }
}
