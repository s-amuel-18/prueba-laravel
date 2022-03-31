<?php

namespace Database\Seeders;

use App\Models\Compra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class compraFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $compras = Compra::factory(7)->create();

        foreach ($compras as $compra) {
            $data_insert = [
                "factura_id" => 1,
                "compra_id" => $compra->id
            ];

            $compra->facturado = 1;
            $compra->save();

            DB::table("compra_factura")->insert($data_insert);
        }

        $compras = Compra::factory(8)->create();
    }
}
