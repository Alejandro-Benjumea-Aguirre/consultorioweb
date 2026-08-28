<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('blood_type', 5)->nullable();
            $table->string('emergency_contact_name', 150)->nullable();
            $table->string('emergency_contact_phone', 30)->nullable();
            $table->string('insurance_provider', 100)->nullable(); // EPS / aseguradora
            $table->string('insurance_number', 50)->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
