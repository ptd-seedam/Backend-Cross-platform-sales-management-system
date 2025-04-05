<?php

namespace App\Console\Commands;

use App\Models\Integration;
use App\Services\IntegrationService;
use Illuminate\Console\Command;

class RefreshExpiringTokens extends Command
{
    protected $signature = 'integrations:refresh-tokens';

    protected $description = 'Refresh tokens that are expired or near expiry';

    public function handle()
    {
        $expiringIntegrations = Integration::where('token_expires_at', '<=', now()->addMinutes(10))->get();
        $service = app(IntegrationService::class);

        foreach ($expiringIntegrations as $integration) {
            $service->refreshTokenIfNeeded($integration);
            $this->info("Refreshed token for shop: {$integration->shop_name}");
        }

        return 0;
    }
}
