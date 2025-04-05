<?php

namespace App\Interfaces;

interface IntegrationRepositoryInterface
{
    public function getUserIntegrations($userId);

    public function createIntegration(array $data);

    public function deleteIntegration($id, $userId);
}
