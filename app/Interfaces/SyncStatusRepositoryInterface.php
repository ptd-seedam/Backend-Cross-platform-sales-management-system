<?php

namespace App\Interfaces;

interface SyncStatusRepositoryInterface
{
    public function getByProductAndChannel($productId, $channel);

    public function updateOrCreate(array $attributes, array $values);

    public function getFailedSyncs();
}
