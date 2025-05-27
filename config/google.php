<?php

return [
    'client_id' => env('1091652537380-7lm5vngpea7mopkikpubldaakrq07hgm.apps.googleusercontent.com'),
    'client_secret' => env('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'),
    'redirect_uri' => env('http://localhost:8000/auth/google/callback'),
    'scopes' => [
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',
    ],
    'access_type' => 'offline',
    'approval_prompt' => 'force',
];
