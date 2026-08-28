<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignUuid('encounter_id')->nullable()->constrained('medical_encounters');
            $table->string('file_name', 255);
            $table->string('file_url', 500);
            $table->string('file_type', 50)->nullable();
            $table->foreignUuid('uploaded_by')->nullable()->constrained('users');
            $table->timestampTz('uploaded_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
