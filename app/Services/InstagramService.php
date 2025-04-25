<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    public function fetchInsights()
    {
        try {
            $response = Http::get(config('social.instagram.api_url') . 'me/media', [
                'fields' => 'id,caption,like_count,comments_count,media_type,timestamp',
                'access_token' => config('social.instagram.access_token')
            ]);

            if ($response->successful()) {
                return $this->formatData($response->json()['data']);
            }

            Log::error('Instagram API Error: ' . $response->body());
            return [];

        } catch (\Exception $e) {
            Log::error('Instagram API Exception: ' . $e->getMessage());
            return [];
        }
    }

    protected function formatData(array $apiData): array
    {
        return array_map(function ($item) {
            return [
                'post_id' => $item['id'],
                'likes' => $item['like_count'] ?? 0,
                'comments' => $item['comments_count'] ?? 0,
                'shares' => 0, // Instagram tidak menyediakan share count
                'views' => $item['video_views'] ?? 0,
                'reach' => 0, // Diisi jika ada data reach
                'engagement' => ($item['like_count'] ?? 0) + ($item['comments_count'] ?? 0),
                'date' => $item['timestamp']
            ];
        }, $apiData);
    }
}
