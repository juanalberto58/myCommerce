<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('tax_base', 10, 2);
            $table->unsignedBigInteger('tax');
            $table->decimal('margin', 10, 2);
            $table->decimal('total', 10, 2);

            // Agrega otros campos relevantes para las compras aquí

            $table->timestamps();

            // $table->foreign('contact_id')->references('id')->on('proveedores');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
