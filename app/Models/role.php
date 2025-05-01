<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class role extends Model
{
// Tambahkan method ini
public function role(): BelongsTo
{
    return $this->belongsTo(Role::class);
}
}
