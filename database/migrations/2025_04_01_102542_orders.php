<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->string('channel'); // Foreign key to stores table
            $table->integer('customer_id'); // Customer ID
            $table->decimal('total_price', 18, 2); // Decimal column for total price
            $table->string('status'); // Order status (Pending, Shipped, Delivered)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
