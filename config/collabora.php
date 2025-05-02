<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Collabora Online Configuration
    |--------------------------------------------------------------------------
    |
    | URL server Collabora Online (CODE/Development Edition).
    | Contoh: http://localhost:9980 atau https://collabora.example.com
    |
    */
    'url' => env('COLLABORA_URL', 'http://localhost:9980'),

    /*
    |--------------------------------------------------------------------------
    | WOPI Settings
    |--------------------------------------------------------------------------
    */
    'wopi' => [
        // Prefix route untuk endpoint WOPI (contoh: /wopi/files/{fileId})
        'route_prefix' => 'wopi',

        // Durasi access token dalam detik (default: 3600 detik / 1 jam)
        'token_lifetime' => env('COLLABORA_TOKEN_LIFETIME', 3600),
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    */
    'security' => [
        // Enkripsi token WOPI (opsional)
        'encrypt_tokens' => env('COLLABORA_ENCRYPT_TOKENS', false),
    ],
];
