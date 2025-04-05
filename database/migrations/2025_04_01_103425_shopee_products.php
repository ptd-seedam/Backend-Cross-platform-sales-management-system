<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shopee_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null'); // Foreign key to products table
            $table->string('shopee_product_id'); // Shopee product ID
            $table->decimal('price', 18, 2); // Price of the product
            $table->integer('stock'); // Stock of the product
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shopee_products');
    }
};