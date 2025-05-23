<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any documents.
     */
    public function viewAny(User $user)
    {
        // Hanya boleh melihat dokumen miliknya sendiri
        return true; // Di-handle oleh query scope di controller
    }

    /**
     * Determine whether the user can view the document.
     */
    public function view(User $user, Document $document)
    {
        // Hanya pemilik dokumen yang bisa melihat
        return $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can create documents.
     */
    public function create(User $user)
    {
        // Semua user yang terautentikasi bisa membuat dokumen
        return true;
    }

    /**
     * Determine whether the user can update the document.
     */
    public function update(User $user, Document $document)
    {
        // Hanya pemilik dokumen yang bisa mengupdate
        return $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can delete the document.
     */
    public function delete(User $user, Document $document)
    {
        // Hanya pemilik dokumen yang bisa menghapus
        return $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can restore the document.
     */
    public function restore(User $user, Document $document)
    {
        // Hanya pemilik dokumen yang bisa merestore
        return $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can permanently delete the document.
     */
    public function forceDelete(User $user, Document $document)
    {
        // Hanya pemilik dokumen yang bisa menghapus permanen
        return $user->id === $document->user_id;
    }
}
