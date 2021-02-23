<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeingKeyFacturaProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factura_producto', function (Blueprint $table) {
            $table
                ->foreign('factura_id')
                ->references('id')
                ->on('facturas')
                ->onDelete('cascade');

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factura_producto', function (Blueprint $table) {
            $table
                ->dropForeign('factura_producto_factura_id');
            $table
                ->dropForeign('factura_producto_product_id');
        });
    }
}
