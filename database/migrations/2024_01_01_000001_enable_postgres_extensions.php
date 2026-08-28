<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Necesaria para el EXCLUDE USING gist de la tabla appointments
        DB::statement('CREATE EXTENSION IF NOT EXISTS "btree_gist"');
    }

    public function down(): void
    {
        DB::statement('DROP EXTENSION IF EXISTS "btree_gist"');
    }
};
