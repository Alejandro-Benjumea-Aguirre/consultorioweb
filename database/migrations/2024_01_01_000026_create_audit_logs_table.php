<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->string('action', 20); // INSERT, UPDATE, DELETE
            $table->string('table_name', 100);
            $table->uuid('record_id')->nullable();
            $table->jsonb('old_data')->nullable();
            $table->jsonb('new_data')->nullable();
            $table->timestampTz('created_at')->useCurrent();

            $table->index(['table_name', 'record_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
