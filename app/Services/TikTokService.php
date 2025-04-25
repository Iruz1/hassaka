<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TikTokService
{
    public function fetchInsights()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('social.tiktok.access_token')
            ])->get(config('social.tiktok.api_url') . 'insights');

            if ($response->successful()) {
                return $this->formatData($response->json()['data']);
            }

            Log::error('TikTok API Error: ' . $response->body());
            return [];

        } catch (\Exception $e) {
            Log::error('TikTok API Exception: ' . $e->getMessage());
            return [];
        }
    }

    protected function formatData(array $apiData): array
    {
        // Format data sesuai dengan struktur database
        return array_map(function ($item) {
            return [
                'post_id' => $item['id'],
                'likes' => $item['like_count'],
                'comments' => $item['comment_count'],
                'shares' => $item['share_count'],
                'views' => $item['view_count'],
                'reach' => $item['reach'] ?? 0,
                'engagement' => $item['engagement'] ?? 0,
                'date' => $item['created_time']
            ];
        }, $apiData);
    }
}
