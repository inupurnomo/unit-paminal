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
        Schema::create('riksa_saksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dumas_id');
            $table->boolean('is_done')->default(false);
            $table->timestamps();

            $table->foreign('dumas_id')->references('id')->on('dumas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riksa_saksis');
    }
};
