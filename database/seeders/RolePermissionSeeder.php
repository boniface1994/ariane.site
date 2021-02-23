<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::create(['name' => 'superadmin']);
        // Role::create(['name' => 'admin']);
        $user = User::where('email', 'nicolas@celaneo.com')->first();
        $user->assignRole('superadmin');
    }
}
