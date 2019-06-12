<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Agudelo',
            'email' => 'daniel.agudelo5169@unaula.edu.co',
            'role' => 'admin',
            'password' => BCRYPT('dagudelot')
        ]);
    }
}
