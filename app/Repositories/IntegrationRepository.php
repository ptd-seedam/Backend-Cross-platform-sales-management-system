<?php

namespace App\Repositories;

use App\Interfaces\IntegrationRepositoryInterface;
use App\Models\Integration;

class IntegrationRepository implements IntegrationRepositoryInterface
{
    public function getUserIntegrations($userId)
    {
        return Integration::where('user_id', $userId)->get();
    }

    public function createIntegration(array $data)
    {
        return Integration::create($data);
    }

    public function deleteIntegration($id, $userId)
    {
        return Integration::where('id', $id)->where('user_id', $userId)->delete();
    }
}
