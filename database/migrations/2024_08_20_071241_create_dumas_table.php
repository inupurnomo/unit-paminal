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
        Schema::create('dumas', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('pelapor');
            $table->string('perihal');
            $table->string('satker');
            $table->unsignedBigInteger('pj_id');
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dumas');
    }
};
