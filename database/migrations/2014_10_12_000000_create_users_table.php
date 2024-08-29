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
          $table->string('username')->unique();
          $table->string('name');
          $table->string('email')->unique()->nullable();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password')->default(bcrypt(env('DEFAULT_PASSWORD')));
          $table->unsignedBigInteger('pangkat_id')->nullable();
          $table->string('jabatan')->nullable();
          $table->unsignedBigInteger('unit_id')->nullable();
          $table->unsignedBigInteger('den_id')->nullable();
          $table->rememberToken();
          $table->timestamps();

          $table->softDeletes();
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