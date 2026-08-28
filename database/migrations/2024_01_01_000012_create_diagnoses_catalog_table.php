<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnoses_catalog', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 10)->unique(); // ej. CIE-10 J06.9
            $table->string('description', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnoses_catalog');
    }
};
