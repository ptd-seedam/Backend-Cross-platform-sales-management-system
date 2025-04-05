<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key to orders table
            $table->string('shipping_address'); // Shipping address
            $table->string('carrier'); // Shipping carrier (e.g., DHL, UPS, FedEx)
            $table->string('tracking_number')->nullable(); // Tracking number, nullable
            $table->timestamp('shipped_date')->nullable(); // Shipped date, nullable
            $table->timestamp('delivered_date')->nullable(); // Delivered date, nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
};