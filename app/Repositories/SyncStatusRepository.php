<?php

namespace App\Repositories;

use App\Interfaces\SyncStatusRepositoryInterface;
use App\Models\SyncStatus;

class SyncStatusRepository implements SyncStatusRepositoryInterface
{
    public function getByProductAndChannel($productId, $channel)
    {
        return SyncStatus::where('product_id', $productId)
            ->where('channel', $channel)
            ->first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return SyncStatus::updateOrCreate($attributes, $values);
    }

    public function getFailedSyncs()
    {
        return SyncStatus::where('synced', false)
            ->whereNotNull('error_message')
            ->get();
    }
}
