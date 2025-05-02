<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentPolicy
{
    /**
     * Determine if the user can view the document.
     */
    public function view(User $user, Document $document): bool
    {
        return $user->id === $document->user_id;
    }

    /**
     * Determine if the user can edit the document via Collabora.
     */
    public function edit(User $user, Document $document): bool
    {
        return $user->id === $document->user_id;
    }

    /**
     * Determine if the user can update the document.
     */
    public function update(User $user, Document $document): bool
    {
        return $user->id === $document->user_id;
    }

    /**
     * Determine if the user can delete the document.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->id === $document->user_id;
    }

    /**
     * Determine if the user can download the document.
     */
    public function download(User $user, Document $document): bool
    {
        return $user->id === $document->user_id || $document->is_public;
    }
}
