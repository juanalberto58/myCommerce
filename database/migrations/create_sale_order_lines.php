<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sale_order_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->string('reference');
            $table->integer('quantity');
            $table->integer('supplier');
            $table->decimal('wholesale_price');
            $table->integer('tax');
            $table->decimal('margin', 10, 2);
            $table->decimal('total');
            // Agrega otros campos relevantes para las líneas de pedido aquí

            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_order_lines');
    }
};
