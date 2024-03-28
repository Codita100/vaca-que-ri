<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'backend']);
        Permission::create(['name' => 'role']);
        Permission::create(['name' => 'email']);
        Permission::create(['name' => 'import']);
        Permission::create(['name' => 'products']);
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'campaigns']);
        Permission::create(['name' => 'catalogue']);
        Permission::create(['name' => 'codes']);
        Permission::create(['name' => 'points']);
        Permission::create(['name' => 'orders']);
        Permission::create(['name' => 'pages']);
        Permission::create(['name' => 'export']);
    }
}
