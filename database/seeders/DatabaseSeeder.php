<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Organization;
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
        // Store default users

        $admin = User::create([
            'name' => 'admin',
            'prenom' => 'admin',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $directeur = User::create([
            'name' => 'directeur',
            'prenom' => 'directeur',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'directeur@gmail.com',
            'password' => Hash::make('directeur'),
        ]);

        $secretaire = User::create([
            'name' => 'secretaire',
            'prenom' => 'secretaire',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'secretaire@gmail.com',
            'password' => Hash::make('secretaire'),
        ]);

        $chef_projet = User::create([
            'name' => 'chef_projet',
            'prenom' => 'chef_projet',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'chef_projet@gmail.com',
            'password' => Hash::make('chef_projet'),
        ]);

        $comptable = User::create([
            'name' => 'comptable',
            'prenom' => 'comptable',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'comptable@gmail.com',
            'password' => Hash::make('comptable'),
        ]);

        // Create Application roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'directeur']);
        Role::create(['name' => 'secretaire']);
        Role::create(['name' => 'chef_projet']);
        Role::create(['name' => 'comptable']);

        // Assigning roles to Application users
        $admin->assignRole('admin');
        $directeur->assignRole('directeur');
        $secretaire->assignRole('secretaire');
        $chef_projet->assignRole('chef_projet');
        $comptable->assignRole('comptable');

        // Organisations seeding
        for ($i = 0; $i < 100; $i++) {
            Organization::create([
                'name' => fake()->company(),
                'address' => fake()->address(),
                'contactPhone' => fake()->phoneNumber(),
                'contactName' => fake()->userName(),
                'contactEmail' => fake()->companyEmail(),
                'website' => fake()->url()
            ]);
        }
    }
}
