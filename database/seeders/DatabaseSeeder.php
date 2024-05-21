<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('users')->insert([
            'nim' => '1234567890',
            'nama' => 'Admin',
            'fnama' => 'Admin',
            'email' => 'admin@binus.edu',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);
    }
}
