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
        Schema::create('sync_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('channel'); // Shopee, TikTok, Lazada, etc.
            $table->boolean('synced')->default(false);
            $table->timestamp('last_synced_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['product_id', 'channel']); // Một sản phẩm chỉ có một bản ghi sync cho mỗi kênh
        });
    }

    public function down()
    {
        Schema::dropIfExists('sync_statuses');
    }
};
