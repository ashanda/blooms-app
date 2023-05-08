<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Role::create([
            'name' => 'Admin'
        ]);
        
        Role::create([
            'name' => 'Front Officer'
        ]);

        Role::create([
            'name' => 'Doctor'
        ]);

        Role::create([
            'name' => 'Accountant'
        ]);

        Role::create([
            'name' => 'Sales Agent'
        ]);

        Role::create([
            'name' => 'Assistant'
        ]);

        Role::create([
            'name' => 'Patient'
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
            'role_id' => 1
        ]);
       

    }
}