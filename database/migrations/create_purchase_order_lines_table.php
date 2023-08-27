<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->string('reference');
            $table->integer('quantity');
            $table->integer('supplier');
            $table->decimal('wholesale_price');
            $table->integer('tax');
            $table->decimal('total');
            // Agrega otros campos relevantes para las líneas de pedido aquí

            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_order_lines');
    }
};
