<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email', 150)->unique();
            $table->string('password'); // hash. Laravel Auth espera esta columna
            $table->enum('role', ['admin', 'doctor', 'patient']);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->enum('document_type', ['CC', 'CE', 'TI', 'PA', 'RC', 'NIT'])->nullable();
            $table->string('document_number', 30)->nullable()->unique();
            $table->string('phone', 30)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['M', 'F', 'OTRO', 'NO_INFORMA'])->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestampTz('email_verified_at')->nullable();
            $table->timestampTz('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestampsTz();

            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
