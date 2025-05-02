<?php

namespace App\Services;

class CollaboraService {
    public function getEditUrl($fileId, $filePath) {
        $collaboraServer = env('COLLABORA_URL', 'http://localhost:9980');
        $wopiSrc = route('wopi.file', ['fileId' => $fileId]);

        return $collaboraServer . '/loleaflet/dist/loleaflet.html?' . http_build_query([
            'WOPISrc' => $wopiSrc,
            'access_token' => bin2hex(random_bytes(16)) // Token acak untuk keamanan
        ]);
    }
}
