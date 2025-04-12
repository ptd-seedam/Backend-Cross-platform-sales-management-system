<?php

use App\Models\Product;
use App\Services\Sync\SyncShopeeService;
use App\Services\Sync\SyncTikTokService;
use Illuminate\Console\Command;

class SyncProductCommand extends Command
{
    protected $signature = 'sync:products {channel}';

    protected $description = 'Đồng bộ sản phẩm lên các kênh bán hàng';

    protected $shopeeSyncService;

    protected $tiktokSyncService;

    public function __construct(
        SyncShopeeService $shopeeSyncService,
        SyncTikTokService $tiktokSyncService
    ) {
        parent::__construct();
        $this->shopeeSyncService = $shopeeSyncService;
        $this->tiktokSyncService = $tiktokSyncService;
    }

    public function handle()
    {
        $channel = $this->argument('channel');
        $products = Product::all();

        foreach ($products as $product) {
            switch ($channel) {
                case 'shopee':
                    $this->info($this->shopeeSyncService->syncProduct($product->id));
                    break;
                case 'tiktok':
                    $this->info($this->tiktokSyncService->syncProduct($product->id));
                    break;
                default:
                    $this->error("Kênh $channel chưa được hỗ trợ.");

                    return 1;
            }
        }

        return 0;
    }
}
