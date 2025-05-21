<?php

return [
    'api_url' => env('http://localhost/'),
    'secret_key' => env('hassakaxunpam'),
    'jwt_enabled' => env('ONLYOFFICE_JWT_ENABLED', true),
    'storage_path' => env('ONLYOFFICE_STORAGE_PATH', 'app\public\documents'),

    'document_types' => [
        'word' => ['doc', 'docx', 'rtf', 'odt', 'txt'],
        'cell' => ['xls', 'xlsx', 'ods', 'csv'],
        'slide' => ['ppt', 'pptx', 'odp'],
    ],
];
