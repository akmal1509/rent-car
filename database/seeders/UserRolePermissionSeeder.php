<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create permissions configuration
        Permission::create(['name' => 'view user/permission']);
        Permission::create(['name' => 'create user/permission']);
        Permission::create(['name' => 'edit user/permission']);
        Permission::create(['name' => 'delete user/permission']);

        //create roles configuration
        Permission::create(['name' => 'view user/role']);
        Permission::create(['name' => 'create user/role']);
        Permission::create(['name' => 'edit user/role']);
        Permission::create(['name' => 'delete user/role']);

        //create user configuration
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        //create car configuration
        Permission::create(['name' => 'view car']);
        Permission::create(['name' => 'create car']);
        Permission::create(['name' => 'edit car']);
        Permission::create(['name' => 'delete car']);

        // action for publish and unpublish
        // Permission::create(['name' => 'publish posts']);
        // Permission::create(['name' => 'unpublish posts']);

        // defaul value for user
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        //create user
        $userSuperadmin = User::create(array_merge([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com'
        ], $default_user_value));

        $userAdmin = User::create(array_merge([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com'
        ], $default_user_value));

        $userWriter = User::create(array_merge([
            'name' => 'writer',
            'username' => 'writer',
            'email' => 'writer@gmail.com'
        ], $default_user_value));

        //create role
        $superadminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'writer']);

        //grant permission for admin for car configuration
        $adminRole->givePermissionTo('view car');
        $adminRole->givePermissionTo('create car');
        $adminRole->givePermissionTo('edit car');
        $adminRole->givePermissionTo('delete car');

        //gift role admin to dummy admin
        $userAdmin->assignRole($adminRole);
    }
}
