<?php

return [
    'tiktok' => [
        'api_url' => env('TIKTOK_API_URL', 'https://api.tiktok.com/v2/'),
        'access_token' => env('TIKTOK_ACCESS_TOKEN'),
    ],

    'instagram' => [
        'api_url' => env('INSTAGRAM_API_URL', 'https://graph.instagram.com/'),
        'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
    ],
];
