<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
//        $this->call(ProductsTableSeeder::class);
//        $this->call(CodSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
//        $this->call(ProductCatalogSeeder::class);

        $superAdminRole = Role::where('name', 'super_admin')->first();
        $corinaeUser = User::where('email', 'corinae@createdirect.ro')->first();
        $corinaeUser->assignRole($superAdminRole);

    }
}
