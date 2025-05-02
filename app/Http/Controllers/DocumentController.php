<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller // Perbaiki huruf besar 'C' pada 'controller'
{
    public function index()
    {
        $documents = Document::where('user_id', auth()->id())->get();
        return view('databank.index', compact('documents'));
    }

    public function showUploadForm()
    {
        return view('databank.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:docx,doc|max:10240',
            'title' => 'required|string|max:255'
        ]);

        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $filename, 'public');

        // Pastikan kolom di sini sesuai dengan migrasi database
        Document::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'filename' => $filename,
            'file_path' => $path
        ]);

        return Redirect::route('databank')->with('success', 'Dokumen berhasil diupload!');
    }

    public function getFile($filename)
    {
        $document = Document::where('filename', $filename)->firstOrFail();

         $path = storage_path('app/public/documents/' . $filename);

         if (!file_exists($path)) {
        abort(404, 'File not found at: ' . $path);
        }

        return response()->file($path, [
            'Content-Type' => mime_content_type($path),
            'X-WOPI-ItemVersion' => $document->updated_at->timestamp
        ]);
        }


            public function edit(Document $document)
            {
                try {
                    // Authorization check
                    $this->authorize('update', $document); // Menggunakan Policy (recommended)

                    // File existence check
                    if (!Storage::exists("public/{$document->path}")) {
                        Log::error("File not found: public/{$document->path}");
                        abort(404, 'File not found in storage');
                    }

                    // Generate WOPI URL
                    $collaboraUrl = $this->generateCollaboraUrl($document);

                    return view('databank.edit', [
                        'collaboraUrl' => $collaboraUrl,
                        'document' => $document
                    ]);

                } catch (\Exception $e) {
                    Log::error("Collabora edit error: " . $e->getMessage());
                    abort(500, 'Failed to initialize document editor');
                }
            }

            /**
             * Generate Collabora Online URL
             */
            protected function generateCollaboraUrl(Document $document): string
            {
                $wopiSrc = route('wopi.files', [
                    'filename' => urlencode($document->filename) // Encode khusus filename
                ]);

                return config('collabora.url') . '/loleaflet/dist/loleaflet.html?' . http_build_query([
                    'WOPISrc' => $wopiSrc,
                    'access_token' => $this->generateAccessToken($document),
                    'ui' => 'notebookbar', // Opsi tampilan (optional)
                    'lang' => app()->getLocale() // Sesuaikan bahasa
                ]);
            }

            /**
             * Generate secure access token
             */
            protected function generateAccessToken(Document $document): string
            {
                return hash_hmac(
                    'sha256',
                    $document->id . now()->timestamp,
                    config('app.key') // Gunakan APP_KEY sebagai salt
                );
            }

}
