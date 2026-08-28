<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encounter_diagnoses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('encounter_id')->constrained('medical_encounters')->cascadeOnDelete();
            $table->foreignUuid('diagnosis_id')->nullable()->constrained('diagnoses_catalog');
            $table->string('diagnosis_text', 255)->nullable(); // texto libre si no está en catálogo
            $table->enum('type', ['PRINCIPAL', 'RELACIONADO'])->default('PRINCIPAL');
            $table->text('notes')->nullable();
            $table->timestampTz('created_at')->useCurrent();

            $table->index('encounter_id');
        });

        DB::statement('ALTER TABLE encounter_diagnoses ADD CONSTRAINT chk_encounter_diagnoses_source CHECK (diagnosis_id IS NOT NULL OR diagnosis_text IS NOT NULL)');
    }

    public function down(): void
    {
        Schema::dropIfExists('encounter_diagnoses');
    }
};
