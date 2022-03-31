<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\Factura;
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
        $this->call(UserSeeder::class);
        $this->call(ProductoSeeder::class);
        // Compra::factory(20)->create();
        Factura::factory(1)->create();
        $this->call(compraFacturaSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
