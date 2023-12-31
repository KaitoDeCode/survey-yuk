<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string("email")->unique();
            $table->string("password")->unique();
            $table->foreignId('role_id')->constrained();
            $table->boolean("permission")->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string("fotoProfil")->nullable();
            $table->enum("persetujuan_surveyor",['disetujui','menunggu','ditolak'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
