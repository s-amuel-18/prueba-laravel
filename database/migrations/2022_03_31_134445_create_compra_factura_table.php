<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_factura', function (Blueprint $table) {
            $table->id();

            $table->foreignId("factura_id")->references("id")->on("facturas")->onDelete("cascade");
            $table->foreignId("compra_id")->references("id")->on("compras")->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_factura');
    }
}
