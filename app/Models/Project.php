<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = [
        'date',
        'project_name',
        'location',
        'description',
        'owner_id',
        'marketing_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    // Relasi ke owner
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id')->withDefault([
            'name' => 'N/A'
        ]);
    }

    // Relasi ke marketing
    public function marketing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketing_id')->withDefault([
            'name' => 'N/A'
        ]);
    }

    // Relasi ke creator
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault([
            'name' => 'System'
        ]);
    }

    // Relasi ke updater
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault([
            'name' => 'N/A'
        ]);
    }

    // Cek hak akses edit
    public function canBeEditedBy(User $user): bool
    {
        return $user->role === 'admin' ||
               $this->owner_id === $user->id ||
               $this->marketing_id === $user->id ||
               $this->created_by === $user->id;
    }

    // Auto-set created_by dan updated_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    // Method untuk log sederhana (opsional)
    public function simpleLog($action)
    {
        if (Auth::check()) {
            // Simpan log ke database atau file sesuai kebutuhan
            // Contoh sederhana:
            \Log::info("Project {$this->id} {$action} by user " . Auth::id());
        }
    }
}
