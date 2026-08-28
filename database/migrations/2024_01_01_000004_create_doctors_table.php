<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('license_number', 50)->unique(); // registro médico / tarjeta profesional
            $table->text('bio')->nullable();
            $table->integer('default_slot_minutes')->default(20); // duración estándar de cita
            $table->decimal('consultation_price', 12, 2)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestampTz('verified_at')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
