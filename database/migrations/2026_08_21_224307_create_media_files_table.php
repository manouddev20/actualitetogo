<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();

            /**
             * Utilisateur qui a ajouté le fichier.
             */
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            /**
             * Type du fichier.
             */
            $table->foreignId('file_type_id')
                ->constrained('file_types')
                ->restrictOnDelete();

            /**
             * Nom généré du fichier.
             */
            $table->string('name');

            /**
             * Chemin du fichier.
             */
            $table->string('path');

            /**
             * Nom original du fichier envoyé.
             */
            $table->string('original_name')->nullable();

            /**
             * Exemple : image/jpeg.
             */
            $table->string('mime_type')->nullable();

            /**
             * Taille du fichier en octets.
             */
            $table->unsignedBigInteger('size')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};