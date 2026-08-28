<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_tests_catalog', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 150);
            $table->string('code', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_tests_catalog');
    }
};
