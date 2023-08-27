<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('tipe');
            $table->string('address');
            $table->string('phone');

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
