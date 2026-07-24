<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('otp_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('otp', 6);
            $table->string('email'); 
            $table->ipAddress('ip_address')->nullable(); 
            $table->text('device_fingerprint')->nullable(); 
            $table->unsignedTinyInteger('attempts')->default(0); 
            // 0 = pending, 1 = verified, 2 = expired
             $table->tinyInteger('status')->default(0);
            $table->dateTime('otp_expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_registers');
    }
};
