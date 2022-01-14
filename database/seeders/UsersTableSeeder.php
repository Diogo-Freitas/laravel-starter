<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'approved'           => 1,
            'is_admin'           => 1,
            'email_verified_at'  => now(),
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        User::factory(99)->create();
    }
}
