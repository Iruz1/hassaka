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

    public function edit(Document $document)
    {
    // Verifikasi kepemilikan dokumen
    if ($document->user_id !== auth()->id()) {
        abort(403);
    }

    // Perbaikan di sini - pastikan nama route sesuai
    $wopiSrc = urlencode(route('wopi.files', $document->filename));
    $collaboraUrl = config('collabora.url') . '/loleaflet/dist/loleaflet.html?WOPISrc=' . $wopiSrc;

    return view('databank.edit', [
        'collaboraUrl' => $collaboraUrl,
        'document' => $document
    ]);
    }
}
