<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medications_catalog', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 150);
            $table->string('active_ingredient', 150)->nullable();
            $table->string('presentation', 100)->nullable(); // ej. tableta, jarabe
            $table->string('concentration', 50)->nullable(); // ej. 500mg
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medications_catalog');
    }
};
