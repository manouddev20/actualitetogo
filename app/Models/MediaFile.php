<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'user_id',
    'file_type_id',
    'name',
    'path',
    'original_name',
    'mime_type',
    'size',
])]

class MediaFile extends Model
{
    use SoftDeletes;

    /**
     * Utilisateur qui a ajouté le fichier.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Type du fichier.
     */
    public function fileType(): BelongsTo
    {
        return $this->belongsTo(FileType::class);
    }

    /**
     * Publications associées au fichier.
    */
    
    public function publications(): BelongsToMany
    {
        return $this->belongsToMany(
            Publication::class,
            'media_file_publication'
        );
    }
}