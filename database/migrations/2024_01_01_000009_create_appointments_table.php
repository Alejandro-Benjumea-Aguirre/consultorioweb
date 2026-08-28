<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->constrained('patients')->restrictOnDelete();
            $table->foreignUuid('doctor_id')->constrained('doctors')->restrictOnDelete();
            $table->timestampTz('starts_at');
            $table->timestampTz('ends_at');
            $table->enum('status', [
                'PROGRAMADA', 'CONFIRMADA', 'EN_CURSO', 'COMPLETADA', 'CANCELADA', 'NO_ASISTIO',
            ])->default('PROGRAMADA');
            $table->string('reason', 255)->nullable(); // motivo indicado por el paciente al agendar
            $table->foreignUuid('cancelled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cancel_reason', 255)->nullable();
            $table->timestampTz('cancelled_at')->nullable();
            $table->timestampsTz();

            $table->index(['doctor_id', 'starts_at']);
            $table->index(['patient_id', 'starts_at']);
            $table->index('status');
        });

        DB::statement('ALTER TABLE appointments ADD CONSTRAINT chk_appointments_time CHECK (ends_at > starts_at)');

        // Evita que un mismo médico tenga dos citas activas que se solapen en el tiempo
        DB::statement("
            ALTER TABLE appointments
            ADD CONSTRAINT appointments_doctor_id_tstzrange_excl
            EXCLUDE USING gist (
                doctor_id WITH =,
                tstzrange(starts_at, ends_at) WITH &&
            ) WHERE (status NOT IN ('CANCELADA', 'NO_ASISTIO'))
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
