<?php

namespace App\Services\Sync;

use App\Models\Product;
use App\Models\ShopeeProduct;
use App\Models\SyncStatus;
use Carbon\Carbon;

class SyncShopeeService
{
    public function syncProduct(int $productId)
    {
        $product = Product::with('variants', 'images', 'category')->find($productId);
        if (! $product) {
            return $this->updateSyncStatus($productId, 'shopee', false, 'Product not found.');
        }

        try {
            // TODO: Gọi API Shopee ở đây và xử lý kết quả trả về
            // Ví dụ:
            // $response = ShopeeAPI::uploadProduct($product);

            // Giả lập:
            ShopeeProduct::updateOrCreate(
                ['product_id' => $productId],
                ['shopee_id' => rand(1000000, 9999999)]
            );

            return $this->updateSyncStatus($productId, 'shopee', true);
        } catch (\Exception $e) {
            return $this->updateSyncStatus($productId, 'shopee', false, $e->getMessage());
        }
    }

    private function updateSyncStatus($productId, $channel, $success, $error = null)
    {
        SyncStatus::updateOrCreate(
            ['product_id' => $productId, 'channel' => $channel],
            [
                'synced' => $success,
                'last_synced_at' => Carbon::now(),
                'error_message' => $error,
            ]
        );

        return $success ? "Đồng bộ sản phẩm $productId lên $channel thành công."
                        : "Đồng bộ thất bại: $error";
    }
}
