<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('encounter_id')->constrained('medical_encounters')->cascadeOnDelete();
            $table->smallInteger('blood_pressure_systolic')->nullable();
            $table->smallInteger('blood_pressure_diastolic')->nullable();
            $table->smallInteger('heart_rate')->nullable();
            $table->smallInteger('respiratory_rate')->nullable();
            $table->decimal('temperature_celsius', 4, 1)->nullable();
            $table->smallInteger('oxygen_saturation')->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('height_cm', 5, 2)->nullable();
            $table->timestampTz('recorded_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
