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
        Schema::create('admin_revenues', function (Blueprint $table) {
              $table->id();
              $table->enum('source', ['subscription','parking_fee']);
              $table->decimal('amount', 8, 2);
              $table->foreignId('parking_id')->nullable();
              $table->foreignId('reservation_id')->nullable();
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_revenues');
    }
};
