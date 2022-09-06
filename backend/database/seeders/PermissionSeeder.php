<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list-users','find-users','create-users','update-users', 'delete-users',
            'list-roles','find-roles','create-roles','update-roles', 'delete-roles',
            'list-permissions','find-permissions','create-permissions','update-permissions', 'delete-permissions',
            'create-files','update-files', 'delete-files',
            'update-global-settings',
        ];

        foreach ($permissions as $permisson) {
            Permission::create([
                'name' => $permisson
            ]);
        }
    }
}
