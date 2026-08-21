<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            /**
             * Utilisateur qui a créé la publication.
             */
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            /**
             * Auteur de la publication.
             */
            $table->foreignId('author_id')
                ->constrained('authors')
                ->restrictOnDelete();

            /**
             * Type de publication.
             */
            $table->foreignId('type_publication_id')
                ->constrained('type_publications')
                ->restrictOnDelete();

            /*
             * Les autres informations seront ajoutées ensuite.
             */
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');

            /*
             * 0 = brouillon
             * 1 = publié
             * 2 = archivé
             */
            $table->tinyInteger('status')->default(0);

            $table->timestamp('published_at')->nullable();

            $table->unsignedBigInteger('views_count')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};