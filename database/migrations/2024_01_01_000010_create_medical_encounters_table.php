<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_encounters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('appointment_id')->nullable()->unique()->constrained('appointments')->nullOnDelete();
            $table->foreignUuid('patient_id')->constrained('patients')->restrictOnDelete();
            $table->foreignUuid('doctor_id')->constrained('doctors')->restrictOnDelete();
            $table->timestampTz('encounter_date')->useCurrent();
            $table->string('chief_complaint', 255)->nullable(); // motivo de consulta
            $table->text('description')->nullable(); // descripción/evolución de la atención
            $table->text('physical_exam_notes')->nullable();
            $table->enum('status', ['EN_CURSO', 'FINALIZADA'])->default('EN_CURSO');
            $table->timestampsTz();

            $table->index('patient_id');
            $table->index('doctor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_encounters');
    }
};
