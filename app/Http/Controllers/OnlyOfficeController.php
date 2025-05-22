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
        return view('databank.index', compact('documents'));
    }

    public function create()
    {
        return view('databank.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:doc,docx,rtf,odt,txt,xls,xlsx,ods,csv,ppt,pptx,odp|max:10240',
        ]);

        $file = $request->file('document');
        $path = $file->store('documents');

        Document::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('databank.index')->with('success', 'Dokumen berhasil diupload');
    }

    public function edit(Document $document)
    {
        $config = OnlyOffice::config()
            ->setDocument($document->name, $document->file_type, Storage::url($document->path))
            ->setCallbackRoute('databank.callback', $document->id)
            ->setLang(app()->getLocale())
            ->setUser(auth()->user()->id, auth()->user()->name);

        return view('databank.edit', [
            'document' => $document,
            'config' => $config->toArray()
        ]);
    }

    public function callback(Request $request, Document $document)
    {
        if (in_array($request->status, [2, 6])) { // Document ready for saving or saved
            $newContent = file_get_contents($request->url);
            Storage::put($document->path, $newContent);
            $document->touch();
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
