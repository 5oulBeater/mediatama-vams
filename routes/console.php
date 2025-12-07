<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Run scheduler for checking video expiration every minute
Schedule::command('video:check-expiration')->everyMinute();

// Example command registering
Artisan::command('video:check-expiration', function () {
    dispatch(new \App\Jobs\CheckVideoExpirationJob());
})->purpose('Check and update expired video access');
