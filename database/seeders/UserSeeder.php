<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            ['email' => 'nicolas@celaneo.com'],
            [
                'name' => 'celaneo',
                'password' => Hash::make('celaneo')
            ]
        );
        Role::updateOrCreate(['name' => 'superadmin']);
        Role::updateOrCreate(['name' => 'admin']);
        $user = User::where('email', 'nicolas@celaneo.com')->first();
        if(!$user->hasRole('superadmin')){
            $user->assignRole('superadmin');
        }
    }
}
