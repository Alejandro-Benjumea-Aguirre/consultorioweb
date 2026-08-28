<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_exceptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->date('exception_date');
            $table->time('start_time')->nullable(); // NULL = todo el día
            $table->time('end_time')->nullable();
            $table->enum('type', ['BLOQUEO', 'DISPONIBILIDAD_EXTRA']);
            $table->string('reason', 255)->nullable();
            $table->timestampTz('created_at')->useCurrent();

            $table->index(['doctor_id', 'exception_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_exceptions');
    }
};
