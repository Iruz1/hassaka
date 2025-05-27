<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    protected $client;
    protected $drive;
    protected $tokenPath;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId("1091652537380-7lm5vngpea7mopkikpubldaakrq07hgm.apps.googleusercontent.com");
        $this->client->setClientSecret("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");
        $this->client->setRedirectUri("http://localhost:8000/google/callback");
        $this->client->setScopes(config('https://www.googleapis.com/auth/drive',
                                        'https://www.googleapis.com/auth/drive.file',));
        $this->client->setAccessType(config('offline'));
        $this->client->setApprovalPrompt(config('force'));

        $this->tokenPath = storage_path('app\credentials.json');

        if (file_exists($this->tokenPath)) {
            $accessToken = json_decode(file_get_contents($this->tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }

        $this->drive = new Drive($this->client);
    }

    public function authenticate()
    {
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                return $this->client->createAuthUrl();
            }

            $this->saveAccessToken();
        }

        return true;
    }

    public function saveAccessToken()
    {
        if (!file_exists(dirname($this->tokenPath))) {
            mkdir(dirname($this->tokenPath), 0700, true);
        }

        file_put_contents($this->tokenPath, json_encode($this->client->getAccessToken()));
    }

    public function handleCallback($code)
    {
        $this->client->fetchAccessTokenWithAuthCode($code);
        $this->saveAccessToken();
        return $this->client->getAccessToken();
    }

    // ==================== DOCUMENT OPERATIONS ====================

    public function uploadFile($name, $content, $mimeType, $parentId = null)
    {
        $fileMetadata = new DriveFile([
            'name' => $name,
            'parents' => $parentId ? [$parentId] : null
        ]);

        $file = $this->drive->files->create(
            $fileMetadata,
            [
                'data' => $content,
                'mimeType' => $mimeType,
                'uploadType' => 'multipart',
                'fields' => 'id,name,webViewLink,webContentLink'
            ]
        );

        return $file;
    }

    public function updateFile($fileId, $newContent, $newName = null)
    {
        $file = new DriveFile();

        if ($newName) {
            $file->setName($newName);
        }

        $updatedFile = $this->drive->files->update(
            $fileId,
            $file,
            [
                'data' => $newContent,
                'fields' => 'id,name,webViewLink,webContentLink'
            ]
        );

        return $updatedFile;
    }

    public function deleteFile($fileId)
    {
        return $this->drive->files->delete($fileId);
    }

    public function getFile($fileId)
    {
        return $this->drive->files->get($fileId, [
            'fields' => 'id,name,webViewLink,webContentLink,mimeType,createdTime,modifiedTime'
        ]);
    }

    public function listFiles($query = "'me' in owners", $pageSize = 10)
    {
        $optParams = [
            'pageSize' => $pageSize,
            'q' => $query,
            'fields' => 'files(id,name,webViewLink,mimeType)',
            'orderBy' => 'modifiedTime desc'
        ];

        return $this->drive->files->listFiles($optParams);
    }

    // ==================== PERMISSIONS ====================

    public function shareFile($fileId, $email, $role = 'writer', $type = 'user')
    {
        $permission = new Permission([
            'type' => $type,
            'role' => $role,
            'emailAddress' => $email
        ]);

        return $this->drive->permissions->create(
            $fileId,
            $permission,
            ['fields' => 'id']
        );
    }

    public function createPublicLink($fileId, $role = 'reader')
    {
        $permission = new Permission([
            'type' => 'anyone',
            'role' => $role
        ]);

        return $this->drive->permissions->create($fileId, $permission);
    }

    // ==================== FOLDERS ====================

    public function createFolder($name, $parentId = null)
    {
        $folderMetadata = new DriveFile([
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => $parentId ? [$parentId] : null
        ]);

        return $this->drive->files->create($folderMetadata, [
            'fields' => 'id,name'
        ]);
    }
}






