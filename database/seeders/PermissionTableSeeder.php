<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('permissions')->truncate();
        $permissions = [
            'Dashoard-menu-access',

            'role-menu-access',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-menu-access',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'admin-settings-menu-access',
            'admin-settings-list',
            'admin-settings-create',
            'admin-settings-edit',
            'admin-settings-delete',

            'clients-menu-access',
            'clients-list',
            'clients-create',
            'clients-edit',
            'clients-delete',

            'branch-menu-access',
            'branch-list',
            'branch-create',
            'branch-edit',
            'branch-delete'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
