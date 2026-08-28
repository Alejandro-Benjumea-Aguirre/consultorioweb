<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('lab_order_item_id')->constrained('lab_order_items')->cascadeOnDelete();
            $table->text('result_text')->nullable();
            $table->string('result_file_url', 500)->nullable(); // PDF/imagen del resultado
            $table->timestampTz('result_date')->nullable();
            $table->foreignUuid('uploaded_by')->nullable()->constrained('users');
            $table->timestampTz('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};
