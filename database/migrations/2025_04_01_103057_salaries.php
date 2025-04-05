<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Foreign key to employees table
            $table->decimal('amount', 18, 2); // Decimal column for salary amount
            $table->timestamp('payment_date'); // Payment date
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salaries');
    }
};