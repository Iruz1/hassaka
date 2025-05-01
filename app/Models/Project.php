<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    protected $fillable = [
        'date',
        'project_name',
        'location',
        'description',
        'owner_id',
        'marketing_id',
        'created_by'
    ];

    // Relasi ke owner
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relasi ke marketing
    public function marketing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketing_id');
    }

    // Relasi ke creator
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Cek hak akses edit
    public function canBeEditedBy(User $user): bool
    {
        return match($user->role->name) {
            'admin' => true,
            'owner' => $this->owner_id === $user->id,
            'marketing' => $this->marketing_id === $user->id,
            default => false
        };
    }

    // Query scope untuk project yang bisa diedit
    public function scopeEditableBy(Builder $query, User $user): void
    {
        $query->when(
            $user->role->name === 'owner',
            fn($q) => $q->where('owner_id', $user->id)
        )->when(
            $user->role->name === 'marketing',
            fn($q) => $q->where('marketing_id', $user->id)
        )->when(
            $user->role->name === 'user',
            fn($q) => $q->where('id', 0) // Tidak ada akses
        );
        // Admin bisa lihat semua (tidak perlu filter)
    }
}
