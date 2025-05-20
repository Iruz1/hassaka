<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TikTokService
{
    protected string $apiUrl = 'https://tiktok-api23.p.rapidapi.com/api/user/posts';
    protected string $apiHost = 'tiktok-api23.p.rapidapi.com';
    protected string $apiKey = 'e9ec6a66aemsh82eb9337f580220p1ecfbajsn3e64217f4f8f';

    public function fetchUserPosts(string $secUid, int $count = 50, int $cursor = 0): array
    {
        try {
            $response = Http::withHeaders([
                'x-rapidapi-host' => $this->apiHost,
                'x-rapidapi-key' => $this->apiKey,
            ])->get($this->apiUrl, [
                'secUid' => $secUid,
                'count' => $count,
                'cursor' => $cursor,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $this->formatPosts($data['data']['itemList'] ?? []);
            }

            Log::error('TikTok API Error: ' . $response->body());
            return [];

        } catch (\Exception $e) {
            Log::error('TikTok API Exception: ' . $e->getMessage());
            return [];
        }
    }

    protected function formatPosts(array $posts): array
    {
        return array_map(function ($post) {
            return [
                'platform' => 'tiktok',
                'post_id' => $post['id'] ?? null,
                'date' => $this->parseDate($post['createTime'] ?? null),
                'likes' => $post['stats']['diggCount'] ?? 0,
                'comments' => $post['stats']['commentCount'] ?? 0,
                'shares' => $post['stats']['shareCount'] ?? 0,
                'views' => $post['stats']['playCount'] ?? 0,
                'raw_data' => json_encode($post) // Store raw response
            ];
        }, $posts);
    }

    protected function parseDate(?string $timestamp): ?string
    {
        if (empty($timestamp)) {
            return null;
        }

        try {
            return date('Y-m-d H:i:s', $timestamp);
        } catch (\Exception $e) {
            Log::warning('Failed to parse TikTok timestamp: ' . $timestamp);
            return null;
        }
    }
}
