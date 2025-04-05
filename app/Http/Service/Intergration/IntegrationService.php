<?php

namespace App\Services;

use App\Interfaces\IntegrationRepositoryInterface;

class IntegrationService
{
    protected $integrationRepository;

    public function __construct(IntegrationRepositoryInterface $integrationRepository)
    {
        $this->integrationRepository = $integrationRepository;
    }

    public function getUserIntegrations($userId)
    {
        return $this->integrationRepository->getUserIntegrations($userId);
    }

    public function connect(array $data)
    {
        return $this->integrationRepository->createIntegration($data);
    }

    public function disconnect($id, $userId)
    {
        return $this->integrationRepository->deleteIntegration($id, $userId);
    }

    public function refreshTokenIfNeeded($integration)
    {
        if (! $integration->token_expires_at || $integration->token_expires_at->isFuture()) {
            return false; // Chưa cần refresh
        }

        // Ví dụ: Gửi request tới API của Shopee hoặc TikTok để lấy token mới
        // (Ở đây giả lập — bạn sẽ cần thư viện HTTP Client như Guzzle)

        $newTokenData = [
            'access_token' => 'new_access_token_abc',
            'refresh_token' => 'new_refresh_token_xyz',
            'token_expires_at' => now()->addDays(7),
        ];

        $integration->update($newTokenData);

        return true;
    }
}
