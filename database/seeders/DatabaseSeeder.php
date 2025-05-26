<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::firstOrCreate(
            ['email' => 'admin@admin.admin'],
            [
                'name' => 'Admin',
                'is_admin' => true,
                'password' => bcrypt('admin'),
            ]
        );


        User::factory(30)->create();
    }
}
