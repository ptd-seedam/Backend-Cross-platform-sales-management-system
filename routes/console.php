<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('integrations:refresh-tokens')->everyFiveMinutes();
Schedule::command('sync:products shopee')->hourly();
Schedule::command('sync:products tiktok')->hourly();
