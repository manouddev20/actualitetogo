<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            /**
             * Utilisateur qui a créé la catégorie.
             */
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};