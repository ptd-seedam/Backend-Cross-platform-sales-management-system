<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key to orders table
            $table->string('payment_method'); // Payment method (Credit Card, PayPal, COD)
            $table->boolean('is_paid')->default(false); // Whether the payment is completed
            $table->timestamp('payment_date')->nullable(); // Payment date, nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
