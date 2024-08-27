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
        Schema::create('n_d_l_h_p_s', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('dumas_id');
          $table->string('file');
          $table->boolean('is_archived')->default(false);
          $table->timestamps();

          $table->foreign('dumas_id')->references('id')->on('dumas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_d_l_h_p_s');
    }
};
