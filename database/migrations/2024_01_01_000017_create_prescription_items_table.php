<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('prescription_id')->constrained('prescriptions')->cascadeOnDelete();
            $table->foreignUuid('medication_id')->nullable()->constrained('medications_catalog');
            $table->string('medication_name', 150)->nullable(); // texto libre si no está en catálogo
            $table->string('dose', 50)->nullable(); // ej. 500 mg
            $table->string('route', 50)->nullable(); // vía de administración
            $table->string('frequency', 50)->nullable(); // ej. cada 8 horas
            $table->string('duration', 50)->nullable(); // ej. 7 días
            $table->string('quantity', 30)->nullable();
            $table->text('instructions')->nullable();

            $table->index('prescription_id');
        });

        DB::statement('ALTER TABLE prescription_items ADD CONSTRAINT chk_prescription_items_source CHECK (medication_id IS NOT NULL OR medication_name IS NOT NULL)');
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
