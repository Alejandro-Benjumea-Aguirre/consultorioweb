<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('encounter_id')->constrained('medical_encounters')->cascadeOnDelete();
            $table->foreignUuid('doctor_id')->constrained('doctors');
            $table->foreignUuid('patient_id')->constrained('patients');
            $table->enum('priority', ['RUTINA', 'URGENTE'])->default('RUTINA');
            $table->enum('status', ['ORDENADO', 'PROGRAMADO', 'REALIZADO', 'CANCELADO'])->default('ORDENADO');
            $table->text('notes')->nullable();
            $table->timestampTz('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_orders');
    }
};
