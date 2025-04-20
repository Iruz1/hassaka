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
            'user_id' => Auth::id(), // Lebih baik menggunakan Auth::id()
            'title' => $request->title,
            'filename' => $filename,
            'file_path' => $path // Ubah 'path' menjadi 'file_path' sesuai error sebelumnya
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
    // Authorization - pastikan user hanya bisa edit dokumen miliknya
        if ($document->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
    }

    // Generate URL untuk Collabora
         $wopiSrc = urlencode(route('wopi.files', $document->filename));
            $collaboraUrl = config('collabora.url') . '/loleaflet/dist/loleaflet.html?WOPISrc=' . $wopiSrc;

        return view('databank.edit', [
            'collaboraUrl' => $collaboraUrl,
            'document' => $document
        ]);
    }
}
