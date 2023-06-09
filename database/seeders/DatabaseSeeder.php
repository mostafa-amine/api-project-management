<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Phase;
use App\Models\Project;
use App\Models\Livrable;
use Illuminate\Support\Str;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        // Create Normal Employees
        for ($i = 0; $i < 10; $i++) {
            $first_name = fake()->firstName();
            $last_name = fake()->lastName();
            $full_name = Str::lower(Str::slug($last_name, '_') . Str::slug($first_name, '_'));

            User::create([
                'name' => $last_name,
                'prenom' => $first_name,
                'photo' => Storage::disk('images')->url('avatar.png'),
                'phone_number' => fake()->phoneNumber(),
                'email' => $full_name . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Organisations seeding
        Organization::create([
            "address" =>  "Casablanca",
            "contactEmail" => "iam@iam.com",
            "contactPhone" => "0623-327-7626",
            "name" =>  "IAM",
            "website"  => "https://www.iam.ma/index.aspx",
            "cover" => "https://www.iam.ma/ImagesMarocTelecom/Phototh%C3%A8que/Images-grandes/maroc-telecom-bleu-fr-grande.jpg"
        ]);

        Organization::create([
            "address" =>  "Casablanca",
            "contactEmail" => "iam@iam.com",
            "contactPhone" => "0623-327-7626",
            "name" =>  "IAM",
            "website"  => "https://www.iam.ma/index.aspx",
            "cover" => "https://www.iam.ma/ImagesMarocTelecom/Phototh%C3%A8que/Images-grandes/maroc-telecom-bleu-fr-grande.jpg"
        ]);

        Organization::create([
            "address" =>  "Usa",
            "contactEmail" => "ibm@ibm.com",
            "contactPhone" => "+1-23-324-7326",
            "name" =>  "IBM",
            "website"  => "https://www.ibm.com",
            "cover" => "https://upload.wikimedia.org/wikipedia/commons/f/fc/IBM_logo_in.jpg"
        ]);

        Organization::create([
            "address" =>  "Canada",
            "contactEmail" => "kptal@kpda.com",
            "contactPhone" => "+1-23-324-7326",
            "name" =>  "Kp Capital",
            "website"  => "https://www.kpcapital.com",
            "cover" => "https://cdn.logojoy.com/wp-content/uploads/2018/05/01104823/1454.png"
        ]);

        // Project seeding
        for ($i = 0; $i < 4; $i++) {
            Project::create([
                'name' => fake()->company(),
                'description' => fake()->paragraph(3),
                'budget' => 1200,
                'start_date' => now(),
                'end_date' => now(),
                'user_id' => 4,
                'progress' => 0,
                'organization_id' => $i + 1,
            ]);
        }

        // Phases seeding

        $randomPhases = [
            'Create Database',
            'Setup Dependencies',
            'Develop CI script',
            'Deploy The Application'
        ];
        for ($i = 0; $i < 4; $i++) {
            Phase::create([
                "code" => "CRP00" . $i + 1,
                "name" => $randomPhases[$i],
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, vitae corrupti. Quidem ducimus rerum quibusdam beatae officiis non animi commodi. Eum repellat corrupti error ullam exercitationem impedit fugiat fugit rerum?",
                "start_date" => now(),
                "end_date" => now(),
                "budget_percentage" => 20,
                "status" => 'Ongoing',
                'project_id' => 1
            ]);
        }

        // Assign Phases to employers

        // Livrables seeding

    }
}
