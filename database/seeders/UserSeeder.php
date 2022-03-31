<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            "name" => "Administrador",
            "email" => "admin@admin.com",
            "rol" => "admin",
            "password" => Hash::make("123456789")
        ]);

        User::create([
            "name" => "Pedro Perez",
            "email" => "pedro@cliente.com",
            // "rol" => "cliente",
            "password" => Hash::make("123456789")
        ]);
        User::create([
            "name" => "Josue Gonzales",
            "email" => "josue@cliente.com",
            // "rol" => "cliente",
            "password" => Hash::make("123456789")
        ]);
    }
}
