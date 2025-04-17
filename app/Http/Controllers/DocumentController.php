<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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

        Document::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'filename' => $filename,
            'path' => $path
        ]);

        return redirect()->route('databank')->with('success', 'Dokumen berhasil diupload!');
    }

    public function edit(Document $document)
    {
        // Verifikasi kepemilikan dokumen
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        $wopiSrc = urlencode(route('wopi.files', $document->filename));
        $collaboraUrl = config('collabora.url') . '/loleaflet/dist/loleaflet.html?WOPISrc=' . $wopiSrc;

        return view('databank.edit', [
            'collaboraUrl' => $collaboraUrl,
            'document' => $document
        ]);
    }

    public function getFile($filename)
    {
        $document = Document::where('filename', $filename)->firstOrFail();

        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->file(storage_path('app/public/documents/' . $filename));
    }
}
