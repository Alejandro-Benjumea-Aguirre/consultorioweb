<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('lab_order_id')->constrained('lab_orders')->cascadeOnDelete();
            $table->foreignUuid('lab_test_id')->nullable()->constrained('lab_tests_catalog');
            $table->string('test_name', 150)->nullable(); // texto libre si no está en catálogo
            $table->text('notes')->nullable();
        });

        DB::statement('ALTER TABLE lab_order_items ADD CONSTRAINT chk_lab_order_items_source CHECK (lab_test_id IS NOT NULL OR test_name IS NOT NULL)');
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_order_items');
    }
};
