<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    protected $driveService;

    public function __construct(GoogleDriveService $driveService)
    {
        $this->driveService = $driveService;
    }

    public function connect()
    {
        $authUrl = $this->driveService->authenticate();

        if ($authUrl === true) {
            return redirect()->route('databank.index')->with('success', 'Already connected to Google Drive');
        }

        return redirect($authUrl);
    }

    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/')->with('error', $request->error);
        }

        $this->driveService->handleCallback($request->code);
        return redirect()->route('databank.index')->with('success', 'Successfully connected to Google Drive');
    }

    public function listFiles()
    {
        $files = $this->driveService->listFiles();
        return view('databank.index', compact('files'));
    }

    public function uploadForm()
    {
        return view('databank.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'name' => 'nullable|string|max:255'
        ]);

        $file = $request->file('file');
        $name = $request->name ?? $file->getClientOriginalName();

        $uploadedFile = $this->driveService->uploadFile(
            $name,
            file_get_contents($file->path()),
            $file->getMimeType()
        );

        return redirect()->route('databank.index')->with('success', 'File uploaded: ' . $uploadedFile->name);
    }

    public function edit($fileId)
    {
        $document = $this->driveService->getFile($fileId);
        $config = $this->driveService->getEditorConfig($document);

        return view('databank.edit', compact('document', 'config'));
    }

    public function update(Request $request, $fileId)
    {
        $request->validate([
            'content' => 'required|string',
            'name' => 'nullable|string|max:255'
        ]);

        $updatedFile = $this->driveService->updateFile(
            $fileId,
            $request->content,
            $request->name
        );

        return redirect()->route('databank.index')->with('success', 'File updated: ' . $updatedFile->name);
    }

    public function shareForm($fileId)
    {
        $file = $this->driveService->getFile($fileId);
        return view('databank.share', compact('file'));
    }

    public function share(Request $request, $fileId)
    {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:reader,writer,commenter'
        ]);

        $this->driveService->shareFile(
            $fileId,
            $request->email,
            $request->role
        );

        return redirect()->route('databank.index')->with('success', 'File shared successfully');
    }

    public function delete($fileId)
    {
        $this->driveService->deleteFile($fileId);
        return redirect()->route('databank.delete')->with('success', 'File deleted successfully');
    }
}
