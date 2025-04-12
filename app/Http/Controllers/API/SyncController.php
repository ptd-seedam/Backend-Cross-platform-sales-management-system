<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SyncStatusRepository;

class SyncController extends Controller
{
    protected $syncStatusRepo;

    public function __construct(SyncStatusRepository $syncStatusRepo)
    {
        $this->syncStatusRepo = $syncStatusRepo;
    }

    // Lấy tất cả sản phẩm chưa đồng bộ thành công
    public function getFailedSyncs()
    {
        $failed = $this->syncStatusRepo->getFailedSyncs();

        return response()->json($failed);
    }

    // Kiểm tra trạng thái đồng bộ của 1 sản phẩm cụ thể
    public function checkProductSync($productId)
    {
        $syncs = $this->syncStatusRepo->getByProductAndChannel($productId, 'shopee'); // bạn có thể truyền động kênh

        return response()->json($syncs);
    }
}
