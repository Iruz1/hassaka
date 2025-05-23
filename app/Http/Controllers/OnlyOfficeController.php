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
        $documents = Document::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('databank.index', compact('documents'));
    }

    public function create()
    {
        return view('databank.upload');
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'document' => 'required|file|mimes:doc,docx,rtf,odt,txt,xls,xlsx,ods,csv,ppt,pptx,odp,pdf|max:10240',
            'description' => 'nullable|string|max:500'
        ]);

        try {
            $file = $request->file('document');
            $originalName = $file->getClientOriginalName();
            $filename = time().'_'.$originalName;
            $path = $file->storeAs('public/documents', $filename);

            $document = Document::create([
                'name' => $originalName,
                'filename' => $filename,
                'path' => 'documents/'.$filename, // relative path
                'file_type' => $file->getClientOriginalExtension(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'description' => $validated['description'] ?? null,
                'user_id' => auth()->id()
            ]);

            return redirect()
                ->route('databank.index')
                ->with('success', 'Dokumen berhasil diupload');

        } catch (\Exception $e) {
            if (isset($path) && Storage::exists($path)) {
                Storage::delete($path);
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal mengupload dokumen: '.$e->getMessage());
        }
    }


    public function edit(Document $document)
    {
        $this->authorize('update', $document);

        try {
            $fileUrl = Storage::url('public/documents/'.$document->filename); // Perubahan disini

            $config = OnlyOffice::config()
                ->setDocument($document->name, $document->file_type, $fileUrl)
                ->setCallbackRoute('databank.callback', $document->id)
                ->setLang(app()->getLocale())
                ->setUser(auth()->id(), auth()->user()->name);

            return view('databank.edit', [
                'document' => $document,
                'config' => $config->toArray()
            ]);

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal membuka editor: '.$e->getMessage());
        }
    }

    public function callback(Request $request, Document $document)
    {
        $this->authorize('update', $document);

        try {
            if (in_array($request->status, [2, 6])) {
                $newContent = file_get_contents($request->url);
                Storage::put('public/documents/'.$document->filename, $newContent); // Perubahan disini
                $document->touch();

                return response()->json(['error' => 0]);
            }

            return response()->json(['error' => 1, 'message' => 'Status dokumen tidak valid']);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 1,
                'message' => 'Gagal menyimpan perubahan: '.$e->getMessage()
            ], 500);
        }
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        try {
            Storage::delete('public/documents/'.$document->filename); // Perubahan disini
            $document->delete();

            return back()
                ->with('success', 'Dokumen berhasil dihapus');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus dokumen: '.$e->getMessage());
        }
    }
}
