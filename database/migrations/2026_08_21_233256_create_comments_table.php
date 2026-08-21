<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('publication_id')
                ->constrained('publications')
                ->cascadeOnDelete();

            /*
             * Utilisateur connecté.
             */
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
             * Commentaire parent.
             * Null = commentaire principal.
             */
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('comments')
                ->cascadeOnDelete();

            /*
             * Utilisateur non connecté.
             */
            $table->string('full_name')->nullable();

            $table->string('email')->nullable();

            /*
             * Le commentaire.
             */
            $table->longText('content');

            /*
             * 0 = en attente
             * 1 = approuvé
             * 2 = rejeté
             * 3 = signalé
             */
            $table->tinyInteger('status')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->index('publication_id');
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};