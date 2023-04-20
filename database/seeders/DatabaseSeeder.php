<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);

        $directeur = User::create([
            'name' => 'directeur',
            'email' => 'directeur@gmail.com',
            'password' => Hash::make('directeur')
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'secretaire']);
        Role::create(['name' => 'directeur']);
        Role::create(['name' => 'chef_projet']);
        Role::create(['name' => 'comptable']);

        $admin->assignRole('admin');
        $directeur->assignRole('directeur');
    }
}
