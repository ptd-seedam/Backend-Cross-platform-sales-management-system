<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['shopee', 'tiktok']);
            $table->string('shop_name');
            $table->text('access_token');
            $table->text('refresh_token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Optional: đảm bảo mỗi user chỉ tích hợp 1 lần mỗi nền tảng (nếu cần)
            $table->unique(['user_id', 'platform']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('integrations');
    }
};
