<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedures_catalog', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 150);
            $table->string('code', 20)->nullable(); // ej. código CUPS
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedures_catalog');
    }
};
