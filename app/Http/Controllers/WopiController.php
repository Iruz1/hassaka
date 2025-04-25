<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WopiController extends Controller
{
    public function show($filename)
    {
        $path = public_path('storage/documents/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->file($path, [
            'Content-Type' => mime_content_type($path),
            'X-WOPI-ItemVersion' => filemtime($path),
        ]);
    }
}
