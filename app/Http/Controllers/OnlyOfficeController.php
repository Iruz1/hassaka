<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OnlyOffice;

class OnlyOfficeController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', auth()->id())->get();
        return view('dashboard.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('dashboard.documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:doc,docx,rtf,odt,txt,xls,xlsx,ods,csv,ppt,pptx,odp',
        ]);

        $file = $request->file('document');
        $path = $file->store(config('onlyoffice.storage_path'));

        Document::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil diupload');
    }

    public function edit(Document $document)
    {
        $config = OnlyOffice::config()
            ->setDocument($document->name, $document->file_type, Storage::url($document->path))
            ->setCallbackRoute('documents.callback', $document->id)
            ->setLang(app()->getLocale())
            ->setUser(auth()->user()->id, auth()->user()->name);

        return view('dashboard.documents.editor', [
            'config' => $config->toArray(),
            'document' => $document,
        ]);
    }

    public function callback(Request $request, Document $document)
    {
        $status = $request->status;

        if ($status === '2' || $status === '6') { // Dokumen siap untuk disimpan atau telah disimpan
            $fileUrl = $request->url;

            // Download dan simpan file yang telah diupdate
            $newContent = file_get_contents($fileUrl);
            Storage::put($document->path, $newContent);

            $document->touch(); // Update timestamp
        }

        return response()->json(['error' => 0]);
    }

    public function destroy(Document $document)
    {
        Storage::delete($document->path);
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }
}
