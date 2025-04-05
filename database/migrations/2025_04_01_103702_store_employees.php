<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('store_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id'); // Foreign key to stores table
            $table->unsignedBigInteger('employee_id'); // Foreign key to employees table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('store_employees');
    }
};