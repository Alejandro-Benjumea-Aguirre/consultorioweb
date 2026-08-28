<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('encounter_id')->constrained('medical_encounters')->cascadeOnDelete();
            $table->foreignUuid('doctor_id')->constrained('doctors');
            $table->foreignUuid('patient_id')->constrained('patients');
            $table->foreignUuid('procedure_id')->nullable()->constrained('procedures_catalog');
            $table->string('procedure_name', 150)->nullable(); // texto libre si no está en catálogo
            $table->enum('priority', ['RUTINA', 'URGENTE'])->default('RUTINA');
            $table->enum('status', ['ORDENADO', 'PROGRAMADO', 'REALIZADO', 'CANCELADO'])->default('ORDENADO');
            $table->text('notes')->nullable();
            $table->timestampTz('created_at')->useCurrent();

            $table->index('patient_id');
        });

        DB::statement('ALTER TABLE procedure_orders ADD CONSTRAINT chk_procedure_orders_source CHECK (procedure_id IS NOT NULL OR procedure_name IS NOT NULL)');
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_orders');
    }
};
