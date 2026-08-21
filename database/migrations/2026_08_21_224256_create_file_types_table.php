<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_types', function (Blueprint $table) {
            $table->id();

            /**
             * Utilisateur qui a créé le type de fichier.
             */
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            /**
             * Exemple : image/jpeg
             */
            $table->string('mime_type')->nullable();

            /**
             * Exemple : jpg, png, mp4, pdf
             */
            $table->string('extension')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_types');
    }
};