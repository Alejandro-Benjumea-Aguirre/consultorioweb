<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->enum('category', [
                'PERSONAL_PATOLOGICO', 'FAMILIAR', 'ALERGICO', 'QUIRURGICO',
                'FARMACOLOGICO', 'TOXICOLOGICO', 'GINECO_OBSTETRICO', 'OTRO',
            ]);
            $table->text('description');
            $table->foreignUuid('recorded_by')->nullable()->constrained('doctors'); // médico que lo registró
            $table->foreignUuid('encounter_id')->nullable()->constrained('medical_encounters');
            $table->boolean('is_active')->default(true); // permite "anular" sin borrar histórico
            $table->timestampsTz();

            $table->index(['patient_id', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_history');
    }
};
