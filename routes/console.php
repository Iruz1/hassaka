<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;

$app = Application::getInstance();

$app->booted(function () use ($app) {
    $schedule = $app->make(Schedule::class);

    // Jadwalkan command fetch insights setiap hari jam 3 pagi
    $schedule->command('insights:fetch')
             ->dailyAt('03:00')
             ->timezone('Asia/Jakarta')
             ->description('Fetch daily insights from TikTok and Instagram');

    // Jadwalkan backup database setiap minggu
    $schedule->command('db:backup')
             ->weekly()
             ->sundays()
             ->at('02:00');

    // Jadwalkan penghapusan data lama setiap bulan
    $schedule->command('insights:cleanup --days=365')
             ->monthly()
             ->description('Cleanup insights older than 1 year');
});
