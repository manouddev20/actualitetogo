<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'user_id',
    'name',
    'slug',
    'mime_type',
    'extension',
])]

class FileType extends Model
{
    use SoftDeletes;

    /**
     * Utilisateur qui a créé le type de fichier.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Les fichiers appartenant à ce type.
     */
    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class);
    }
}