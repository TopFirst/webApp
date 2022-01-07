<?php

namespace Database\Seeders;

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
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'page-list',
            'page-create',
            'page-edit',
            'page-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'master-list',
            'master-create',
            'master-edit',
            'master-delete',
            'setting-list',
            'setting-create',
            'setting-edit',
            'setting-delete'
         ];
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
