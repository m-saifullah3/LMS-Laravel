<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //  User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => '$2y$10$f6nJHXPzg1UMI6ocfp5qaO92ZxLiTV.43Ksz2l3JrM/Aj96B8M3h2',
        //     'user_type' => 'admin',
        // ]);


        // Role::factory()->create([        
        //     'role' => 'Super Admin', 
        //     'created_at' => now(),
        // ]);

        // Admin::factory()->create([        
        //     'user_id' => 1, 
        //     'role_id' => 1, 
        //     'created_at' => now(),
        // ]);

        User::factory()->count(300)->create();
        Student::factory()->count(200)->create();
    }
}
