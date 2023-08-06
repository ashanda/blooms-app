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
            'nic' => '123456789V',
            'email' => 'admin@admin.com',
            'salary' => '12345',
            'joining_date' => '2015-09-30',
            'password' => Hash::make('123456789'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Front Officer',
            'nic' => '123456789V',
            'email' => 'officer@officer.com',
            'salary' => '12345',
            'joining_date' => '2015-09-30',
            'password' => Hash::make('123456789'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Doctor',
            'nic' => '123456789V',
            'email' => 'doctor@doctor.com',
            'salary' => '12345',
            'joining_date' => '2015-09-30',
            'password' => Hash::make('123456789'),
            'role_id' => 3
        ]);
        User::create([
            'name' => 'Sale Agent',
            'nic' => '123456789V',
            'email' => 'sale@sale.com',
            'salary' => '12345',
            'joining_date' => '2015-09-30',
            'password' => Hash::make('123456789'),
            'role_id' => 5
        ]);
        User::create([
            'name' => 'Assistant',
            'nic' => '123456789V',
            'email' => 'assistant@assistant.com',
            'salary' => '12345',
            'joining_date' => '2015-09-30',
            'password' => Hash::make('123456789'),
            'role_id' => 6
        ]);
       

    }
}
