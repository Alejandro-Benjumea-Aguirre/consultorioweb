<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->unsignedTinyInteger('day_of_week'); // 0=domingo ... 6=sábado
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('slot_minutes')->default(20);
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestampTz('created_at')->useCurrent();

            $table->index('doctor_id');
        });

        DB::statement('ALTER TABLE doctor_schedules ADD CONSTRAINT chk_doctor_schedules_day CHECK (day_of_week BETWEEN 0 AND 6)');
        DB::statement('ALTER TABLE doctor_schedules ADD CONSTRAINT chk_doctor_schedules_time CHECK (end_time > start_time)');
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
