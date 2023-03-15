<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'icon' => 'fas fa-fire',
            'sort' => '1',
            'main_menu' => null,
        ]);
        Menu::create([
            'name' => 'Cars',
            'slug' => 'cars',
            'icon' => 'fas fa-car',
            'sort' => '2',
            'main_menu' => null,
        ]);
        Menu::create([
            'name' => 'Blogs',
            'slug' => 'blogs',
            'sort' => '3',
            'icon' => 'fas fa-columns',
            'main_menu' => null,
        ]);
        Menu::create([
            'name' => 'Users',
            'slug' => 'users',
            'icon' => 'fas fa-user',
            'sort' => '4',
            'main_menu' => null,
        ]);
        Menu::create([
            'name' => 'Settings',
            'slug' => 'settings',
            'icon' => 'fas fa-tools',
            'sort' => '5',
            'main_menu' => null,
        ]);
        Menu::create([
            'name' => 'Master Cars',
            'slug' => 'cars',
            'icon' => '',
            'sort' => '1',
            'main_menu' => 2,
        ]);
        Menu::create([
            'name' => 'Brands',
            'slug' => 'brands',
            'icon' => '',
            'sort' => '2',
            'main_menu' => 2,
        ]);

        Menu::create([
            'name' => 'Master Blogs',
            'slug' => 'blogs',
            'icon' => '',
            'sort' => '1',
            'main_menu' => 3,
        ]);
        Menu::create([
            'name' => 'Categories',
            'slug' => 'categories',
            'icon' => '',
            'sort' => '2',
            'main_menu' => 3,
        ]);

        Menu::create([
            'name' => 'Roles',
            'slug' => 'roles',
            'icon' => '',
            'sort' => '1',
            'main_menu' => 4,
        ]);
        Menu::create([
            'name' => 'Menus',
            'slug' => 'menus',
            'icon' => '',
            'sort' => '2',
            'main_menu' => 4,
        ]);
        Menu::create([
            'name' => 'Permissions',
            'slug' => 'permissions',
            'icon' => '',
            'sort' => '2',
            'main_menu' => 4,
        ]);
    }
}
