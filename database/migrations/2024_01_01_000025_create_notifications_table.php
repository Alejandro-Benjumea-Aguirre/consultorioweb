<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', [
                'CITA_CREADA', 'CITA_RECORDATORIO', 'CITA_CANCELADA', 'RESULTADO_DISPONIBLE', 'GENERAL',
            ]);
            $table->string('title', 150);
            $table->text('message')->nullable();
            $table->foreignUuid('related_appointment_id')->nullable()->constrained('appointments');
            $table->boolean('is_read')->default(false);
            $table->timestampTz('created_at')->useCurrent();

            $table->index(['user_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
