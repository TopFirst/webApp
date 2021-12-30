<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Topik', 
            'alamat' => 'Tembesi', 
            'hp' => '6285668190996', 
            // 'foto' => 'uploads/users/topik.png',
            'email' => 'topik@tmg.com',
            'password' => bcrypt('123456')
        ]);
    

        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
   
        //untuk kurir
        $user_contributor = User::create([
            'name' => 'bobi', 
            'alamat' => 'Tembesi', 
            'hp' => '6282174788182', 
            // 'foto' => 'uploads/users/bobi.jpg', 
            'email' => 'bobi@tmg.com',
            'password' => bcrypt('bobi123')
        ]);

        $role_contributor = Role::create(['name' => 'Editor']);

        $permissions_post_list=Permission::findByName('post-list');
        $role_contributor->givePermissionTo($permissions_post_list);
        $permissions_post_list->assignRole($role_contributor);
        
        $permissions_trx_create=Permission::findByName('post-create');
        $role_contributor->givePermissionTo($permissions_trx_create);
        $permissions_trx_create->assignRole($role_contributor);

        $user_contributor->assignRole([$role_contributor->id]);

        Role::create(['name' => 'Contributor']);
        Role::create(['name' => 'Subscriber']);
    }
}
