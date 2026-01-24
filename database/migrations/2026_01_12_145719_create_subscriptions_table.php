<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('plan', ['basic','premium']);
            $table->decimal('price', 8, 2)->default(0);

            $table->integer('hours_limit')->default(0);
            $table->integer('days_limit')->default(0);
            $table->integer('hours_used')->default(0);
            $table->integer('days_used')->default(0);

            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'expired'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
