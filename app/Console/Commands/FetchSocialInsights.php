<?php

namespace App\Console\Commands;

use App\Services\TikTokService;
use App\Services\InstagramService;
use Illuminate\Console\Command;

class FetchSocialInsights extends Command
{
    protected $signature = 'insights:fetch';
    protected $description = 'Fetch insights data from TikTok and Instagram APIs';

    public function __construct(
        protected TikTokService $tiktokService,
        protected InstagramService $instagramService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Fetching TikTok insights...');
        $tiktokData = $this->tiktokService->fetchInsights();
        $this->info('Fetched ' . count($tiktokData) . ' TikTok posts');

        $this->info('Fetching Instagram insights...');
        $instagramData = $this->instagramService->fetchInsights();
        $this->info('Fetched ' . count($instagramData) . ' Instagram posts');

        $this->info('Data fetching completed!');
        return 0;
    }
}
