<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->dateTime('birthdate')->nullable();
            $table->string('phone', 9);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        // Purchases Table
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('tax_base', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contact');
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['id']);
        });

        // Purchase Order Lines Table
        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id');
            $table->string('reference');
            $table->integer('quantity');
            $table->unsignedBigInteger('supplier');
            $table->decimal('wholesale_price', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->foreign('supplier')->references('id')->on('contact');

            $table->primary(['id']);
        });

        // Sales Table
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('tax_base', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('margin', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contact');
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['id']);
        });

        // Sale Order Lines Table
        Schema::create('sale_order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id');
            $table->string('reference');
            $table->integer('quantity');
            $table->unsignedBigInteger('supplier');
            $table->decimal('wholesale_price', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('margin', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('supplier')->references('id')->on('contact');

            $table->primary(['id']);
        });

        // Products Table
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('description');
            $table->decimal('weight', 10, 2);
            $table->decimal('width', 10, 2);
            $table->decimal('height', 10, 2);
            $table->decimal('length', 10, 2);
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['id']);
        });

        // Contact Table
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni', 10)->unique();
            $table->string('name');
            $table->string('lastname');
            $table->dateTime('birthdate')->nullable();
            $table->string('email')->unique();
            $table->string('type');
            $table->string('address');
            $table->string('phone', 9);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact');
        Schema::dropIfExists('products');
        Schema::dropIfExists('sale_order_lines');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('purchase_order_lines');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('users');
    }
}
