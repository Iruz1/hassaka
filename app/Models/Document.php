<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    // app/Models/Document.php
    protected $fillable = ['user_id', 'title', 'filename', 'file_path'];

        public function user()
     {
        return $this->belongsTo(User::class);
    }
}
