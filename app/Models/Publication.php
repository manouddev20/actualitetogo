<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'author_id',
    'type_publication_id',
    'title',
    'slug',
    'content',
    'status',
    'published_at',
])]

class Publication extends Model
{
    use SoftDeletes;

    /**
     * Utilisateur qui a créé la publication.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Auteur de la publication.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Type de la publication.
     */
    public function typePublication(): BelongsTo
    {
        return $this->belongsTo(TypePublication::class);
    }

    /**
     * Les catégories de la publication.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Les tags de la publication.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


    public function likes(): HasMany
    {
        return $this->hasMany(PublicationLike::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(PublicationView::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * Les fichiers de la publication.
     */
    public function mediaFiles(): BelongsToMany
    {
        return $this->belongsToMany(
            MediaFile::class,
            'media_file_publication'
        );
    }
}